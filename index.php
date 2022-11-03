<?php

require_once 'vendor/autoload.php';
$ffmpeg = FFMpeg\FFMpeg::create(array(
    'ffmpeg.binaries'  => '/opt/homebrew/bin/ffmpeg',
    'ffprobe.binaries' => '/opt/homebrew/bin/ffprobe',
    'timeout'          => 3600, // The timeout for the underlying process
    'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
));
$format = new FFMpeg\Format\Video\X264();
$format->setAudioCodec("aac");
$videoFile='migration.mp4';
$captionStaticFilePath=$_SERVER['DOCUMENT_ROOT'].'/';
$outputFile='movie_output.mp4';
$text="Stackoverflow";
$command = "text='$text': fontfile=OpenSans-Regular.ttf: fontcolor=red: fontsize=80: box=1: boxcolor=black@0.5: boxborderw=5: x=(w-text_w)/2: y=(h-text_h)/2:";

try{
        $video = $ffmpeg->open($captionStaticFilePath.$videoFile);
        $video->filters()->custom("drawtext=$command");
        $video->save($format, $captionStaticFilePath.$outputFile);
        die('done');
}catch(Exception $e){
        echo $e->getMessage();die;
}


?>
