<?php

namespace Tests\Unit;

use App\Models\Episode;
use App\Models\Season;
//use PHPUnit\Framework\TestCase; -> não extende a conexão com o banco
use Tests\TestCase;

class SeasonTest extends TestCase
{
    /** @var Season */
    private $season;

    /** Método chamado antes de cada teste rodar */
    protected function setUp(): void
    {
        parent::setUp();

        $season = new Season();

        $episodeOne = new Episode();
        $season->episodes->add($episodeOne);
        $episodeOne->watched = true;

        $episodeTwo = new Episode();
        $season->episodes->add($episodeTwo);
        $episodeTwo->watched = false;

        $episodeThree = new Episode();
        $season->episodes->add($episodeThree);
        $episodeThree->watched = true;

        $this->season = $season;
    }

    public function testFindForWatchedEpisodes()
    {
        $watchedEpisodes = $this->season->getWatchedEpisodes();

        $this->assertCount(2, $watchedEpisodes);

        foreach ($watchedEpisodes as $episode) {
            $this->assertTrue($episode->watched);
        }
    }

    public function testFindForAllEpisodes()
    {
        $episodes = $this->season->episodes;

        $this->assertCount(3, $episodes);
    }
}
