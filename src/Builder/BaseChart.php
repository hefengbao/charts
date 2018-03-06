<?php

namespace HeFengbao\Charts\Builder;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class BaseChart
{
    /**
     * Stores the chart ID.
     * @var string
     */
    public $id;

    /**
     * Stores the chart theme.
     * @var string
     */
    public $theme = 'default';

    /**
     *Stores the chart DataSet.
     * @var array
     */
    public $dataset = [];

    /**
     *Determines if the loader is show.
     * @var bool
     */
    public $loader = true;

    /**
     * Determines if the loader color.
     *
     * @var string
     */
    public $loaderColor = '#22292F';

    /**
     * Stores the API url if the chart is loaded over API.
     * @var string
     */
    public $api_url = '';

    /**
     * Stores the height of the chart.
     *
     * @var string
     */
    public $height = '400px';

    /**
     * Stores the width of the chart.
     *
     * @var string
     */
    public $width = '100 %';

    /**
     * Stores the chart options.
     * @var array
     */
    public $options = [];

    /**
     * Stores the chart container.
     * @var string
     */
    public $container = '';

    /**
     * Stores the chart script.
     * @var string
     */
    public $script = '';

    /**
     * Stores the available chart letters to create the ID.
     *
     * @var string
     */
    private $chartLetters = 'abcdefghijklmnopqrstuvwxyz';

    public function __construct()
    {
        $this->id = substr(str_shuffle(str_repeat($x = $this->chartLetters, ceil(25 / strlen($x)))), 1, 25);
    }

    /**
     *Set the chart theme.
     * @param string $theme
     * @return $this
     */
    public function theme(string $theme)
    {
        return $this->theme = $theme;
    }

    /**
     * Set the Api url.
     *
     * @param string $url
     * @return $this
     */
    public function load(string $url)
    {
        return $this->api_url = $url;
    }

    /**
     * Set if show loader.
     * @param bool $loader
     * @return bool
     */
    public function loader(bool $loader)
    {
        return $this->loader = $loader;
    }

    /**
     * Set the loader color.
     * @param string $color
     * @return $this
     */
    public function loaderColor(string $color)
    {
        return $this->loaderColor = $color;
    }

    /**
     * Chart container.
     * @param string|null $container
     * @return string
     */
    public function container(string $container = null)
    {
        if (!$container) {
            return View::make($this->container, ['chart' => $this]);
        }

        return $this->container = $container;
    }

    /**
     *The height of chart container.
     * @param int $height
     * @return string
     */
    public function height(int $height)
    {
        return $this->height = $height . 'px';
    }

    /**
     * The width of chart container.
     * @param int $width
     * @return string
     */
    public function width(int $width)
    {
        return $this->width = $width . 'px';
    }

    /**
     * @param string|null $script
     * @return $this
     * @throws \Exception
     */
    public function script(string $script = null)
    {
        if (count($this->dataset) == 0 && !$this->api_url) {
            throw new \Exception('No datasets provided, please provide at least one dataset to generate a chart');
        }
        if (!$script) {
            return View::make($this->script, ['chart' => $this]);
        }

        $this->script = $script;

        return $this;
    }

    /**
     * @param $options
     * @param bool $overwrite
     * @return $this
     */
    protected function setOptions($options, bool $overwrite = false)
    {
        if ($options instanceof Collection) {
            $options = $options->toArray();
        }

        if ($overwrite) {
            $this->options = $options;
        } else {
            $this->options = array_replace_recursive($this->options, $options);
        }

        return $this;
    }

    /**
     * @return bool|string
     */
    public function formatOptions()
    {
        return $options = substr(json_encode($this->options), 1, -1);
    }

    public function formatDatasets()
    {
        // This little boy was commented because it's not compatible
        // in laravel < 5.4
        //
        // return Collection::make($this->datasets)
        //     ->each
        //     ->matchValues(count($this->labels))
        //     ->map
        //     ->format($this->labels)
        //     ->toJson();

        /*return Collection::make($this->datasets)
            ->each(function ($dataset) {
                $dataset->matchValues(count($this->labels));
            })
            ->map(function ($dataset) {
                return $dataset->format($this->labels);
            })
            ->toJson();*/
        /*$this->options([
            "dataset" => [
                "source" => $data
            ]
        ]);*/
        return json_encode($this->dataset);
    }

    /**
     * @return string
     */
    public function formatContainerOptions()
    {
        return 'style="height: ' . $this->height . ';width: ' . $this->width . '%" ';
    }
}