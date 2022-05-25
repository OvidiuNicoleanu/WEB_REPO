<?php
namespace PHP\connection;


class TMDBController
{
    /**
     * Credentials from TMDB API.
     */
    const API_KEY = 'api_key=655aa5955b48a73215dd5e50081e738b';
    const BASE_URL = 'https://api.themoviedb.org/3';
    const IMG_URL = 'https://image.tmdb.org/t/p/w500';
    const SEARCH_MOVIE = '/search/movie?';
    const SEARCH_PERSON = '/search/person?';
    const SEARCH_BY_KEYWORD = '/search/keyword?';
    const SEARCH_TRENDING = '/trending';
    public $personName;
    public $movieName;
    public $keyword;
    public $file;
    public $media_type;
    public $time_window;
    public function __construct()
    {
    }

    public function findActor() {
       // $name = [];
        //$tok = strtok($this->personName, " ");
        //$firstName=$tok;
        //while ($tok !== false) {
           // $name[] = $tok;
            //$tok = strtok(";");
       // }
        $the_full_name = str_replace(' ', '%20', $this->personName);
        //$tok = strtok(" ");
       // $lastName = $tok;
        $file = file_get_contents($this::BASE_URL . $this::SEARCH_PERSON . $this::API_KEY . "&query=" . $the_full_name);
        echo $file."\n \n";
    }
    public function findAMovie() {
        $movieName = $this->movieName;

        $file = file_get_contents($this::BASE_URL . $this::SEARCH_MOVIE . $this::API_KEY . "&query=" . $movieName);
        echo $file;
    }
    public function findByKeywords() {
        $keyword = $this->keyword;

        $file = file_get_contents($this::BASE_URL . $this::SEARCH_BY_KEYWORD . $this::API_KEY . "&query=" . $keyword);
        echo $file;
    }
    public function trending($the_media_type,$the_time_window) {
        $media_type=$the_media_type;
        $time_window=$the_time_window;

            $file = file_get_contents($this::BASE_URL . $this::SEARCH_TRENDING . "/?" . $media_type . "/?" . $time_window . "?" . $this::API_KEY);
            echo $file;

    }


    /**
     * Getter
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Getter
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Setter
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }
}