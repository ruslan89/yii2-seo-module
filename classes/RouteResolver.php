<?php

namespace ruslan89\seo\classes;

use ruslan89\seo\classes\exceptions\SeoPageNotFoundException;
use ruslan89\seo\models\SeoPage;

class RouteResolver
{
    /** @var  array */
    private $routeMatches = [];

    /** @var  SeoTagsDataObject */
    protected $seoDataObject;

    /**
     * @param $url
     */
    public function resolve($url)
    {
        foreach ($this->getSeoPages() as $seoPage) {
            if (RegExpDecorator::match($seoPage->route, $url, $matches) === 1) {
                $this->routeMatches = $matches;
                $this->seoDataObject = new SeoTagsDataObject($seoPage);
                return;
            }
        }
    }

    /**
     * @return array|SeoPage[]
     */
    public function getSeoPages()
    {
        return SeoPage::find()->orderBy(['priority' => SORT_DESC])->all();
    }

    /**
     * @return array
     */
    public function getRouteMatches()
    {
        return $this->routeMatches;
    }

    /**
     * @return SeoTagsDataObject
     * @throws SeoPageNotFoundException
     */
    public function getSeoDataObject()
    {
        if (empty($this->seoDataObject)) {
            throw new SeoPageNotFoundException();
        }
        return $this->seoDataObject;
    }
}
