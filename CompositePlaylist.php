<?php
interface Track
{
  function totalLength();
}

class Song implements Track
{
  private $location;
  private $title;

  function __construct($loc, $tit)
  {
    $this->location = $loc;
    $this->title = $tit;
    $this->data = random_int (0, 100);
  }

  function totalLength()
  {
    return $this->data;
  }

  function getLocation()
  {
    return $this->location;
  }

  function getTitle()
  {
    return $this->title;
  }
}

abstract class CompositePlayList implements Track
{
  private $songs;
  private $type;

  function __construct($type)
  {
    $this->songs = array();
    $object = "{$type}Playlist";
    $this->type = new $object;
  }

  function addSong(Song $song)
  {
    $this->songs[] = $song;
  }

  function removeSong( Song $song ) 
  {
    $this->songs = array_udiff( 
        $this->songs, array( $song ),
        function($a, $b) { return ($a === $b) ? 0 : 1; } 
      );
  }

  protected function getType()
  {
    return $this->type;
  }

  protected function getSongs()
  {
    return $this->songs;
  }

  function totalLength()
  {
    $ret = 0;
    foreach($this->songs as $song)
    {
      $ret += $song->totalLength();
    }
    return $ret;
  }

  abstract public function getPlaylist();
}


class Playlist extends CompositePlayList
{
  public function getPlaylist()
  {
    $playlist = $this->getType()->getPlaylist($this->getSongs());
    // var_dump($this->totalLength());
    $total = "\r\n--------------Total Length: {$this->totalLength()}\r\n" ;
    return $playlist . $total;
  }
}


class plsPlaylist
{
  public function getPlaylist($songs)
  {
    $pls = "[playlist]\nNumberOfEntries=" . count($songs) . "\n\n";
    foreach ($songs as $songCount => $song) {
      $counter = $songCount + 1;
      $pls .= "File{$counter}={$song->getLocation()}\n";
      $pls .= "Title{$counter}={$song->getTitle()}\n";
      $pls .= "Length{$counter}={$song->totalLength()}\n\n";
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
      $m3u .= "{$song->getLocation()}\n";
    }
    return $m3u;
  }
}




$externalRetrievedType = 'pls';
$playlist = new Playlist($externalRetrievedType);

$playlist->addSong(new Song('/home/aaron/music/brr.mp3', 'Brr'));
$playlist->addSong(new Song('/home/aaron/music/goodbye.mp3', 'Goodbye'));

$playlistContent = $playlist-> getPlaylist();
print_r($playlistContent);

$externalRetrievedType = 'm3u';
$playlist = new Playlist($externalRetrievedType);
$playlist->addSong(new Song('/home/aaron/music/brr.mp3', 'Brr'));
$playlist->addSong(new Song('/home/aaron/music/goodbye.mp3', 'Goodbye'));

$playlistContent = $playlist-> getPlaylist();
print_r($playlistContent);
?>