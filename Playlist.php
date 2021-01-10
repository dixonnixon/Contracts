<?php
class PlayList
{
  private $songs;
  private $type;

  function __construct($type)
  {
    $this->songs = array();
    $object = "{$type}Playlist";
    $this->type = new $object;
  }

  function addSong($loc, $title)
  {
    $song = array("location" => $loc, "title" => $title);
    $this->songs[] = $song;
  }

  public function getPlaylist()
  {
    $playlist = $this->type->getPlaylist($this->songs);
    return $playlist;
  }
}

class plsPlaylist
{
  public function getPlaylist($songs)
  {
    $pls = "[playlist]\nNumberOfEntries=" . count($songs) . "\n\n";
    foreach ($songs as $songCount => $song) {
      $counter = $songCount + 1;
      $pls .= "File{$counter}={$song['location']}\n";
      $pls .= "Title{$counter}={$song['title']}\n";
      $pls .= "Length{$counter}=-1\n\n";
    }
    return $pls;
  }
}

class m3uPlaylist
{
  public function getPlaylist($songs)
  {
    $m3u = "#EXTM3U\n\n";
    foreach ($songs as $song) {
      $m3u .= "{$song['location']}\n";
    }
    return $m3u;
  }
}


$externalRetrievedType = 'pls';
$playlist = new Playlist($externalRetrievedType);
$playlist->addSong('/home/aaron/music/brr.mp3', 'Brr');
$playlist->addSong('/home/aaron/music/goodbye.mp3', 'Goodbye');

$playlistContent = $playlist-> getPlaylist();
print_r($playlistContent);

$externalRetrievedType = 'm3u';
$playlist = new Playlist($externalRetrievedType);
$playlist->addSong('/home/aaron/music/brr.mp3', 'Brr');
$playlist->addSong('/home/aaron/music/goodbye.mp3', 'Goodbye');

$playlistContent = $playlist-> getPlaylist();
print_r($playlistContent);
?>