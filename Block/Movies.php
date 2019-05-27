<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Block;

use stdClass;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Data\Form\FormKey;

use Capcj\TheMovieDb\Lib\TheMovieDbAPI\Search;

class Movies extends Template
{
    /**
     * @var string
     **/
    protected $formKey;

    /**
     * @var string|null
     **/
    protected $movieName;

    public function __construct(Context $context, FormKey $formKey)
	{
        $this->formKey = $formKey;
        $this->movieName = filter_input(
            INPUT_POST,
            'movie_name',
            FILTER_SANITIZE_SPECIAL_CHARS
        );
		parent::__construct($context);
	}

    public function getFormKey(): string
    {
         return $this->formKey->getFormKey();
    }

    public function getMovieName(): string
    {
        return $this->movieName ?? '';
    }

    public function listMovies(): array
    {
        if ($this->movieName === null) {
            return [];
        }

        return (new Search())->movie($this->movieName)->build()->results ?? [];
    }

    public function movieHtml(stdClass $movie): string
    {
        $humanizedReleaseDate = date('d F Y', strtotime($movie->release_date));

        return <<<HTML
<article id='$movie->id'>
    <header>
        <img src='http://image.tmdb.org/t/p/w200/$movie->poster_path'>
        <h2 class='title'>$movie->title</h2>
        <p>
            Release date:
            <time datetime='$movie->release_date'>$humanizedReleaseDate</time>
        </p>
    </header>
    <p class='overview ellipsis' title='$movie->overview'>$movie->overview</p>
    <button type='submit' name='add_product_btn' class='primary' id='add-product-btn'>
        Add as Product
    </button>
</article>
HTML;
    }
}
