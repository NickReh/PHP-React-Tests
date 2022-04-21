<?php

class Category {
    //Category props
    public $id;
    public $parentCategoryId;
    public $name;
    public $hasTools;

    //constructor
    public function __construct(){
        //
    }

    private function prepareCategories(&$category, $categories) {
        $categoryId = $category["id"];
        $childCategories = array_filter($categories, function ($cat) use($categoryId) { return $categoryId == $cat["parentCategoryId"]; });
        foreach($childCategories as &$childCat) {
            $this->prepareCategories($childCat, $categories);
        }

        if (count($childCategories) > 0) {
            $category["childCategories"] = $childCategories;
        }
    }

    public function read() {
        //dummy data
        $cat1 = array("id"=>1, "parentCategoryId"=>null, "name"=>"More Categories", "hasTools"=>false);
        $cat2 = array("id"=>2, "parentCategoryId"=>1, "name"=>"Draw", "hasTools"=>true);
        $cat3 = array("id"=>3, "parentCategoryId"=>1, "name"=>"Effects", "hasTools"=>true);

        $categories = array (
            $cat1,
            $cat2,
            $cat3
        );

        //filter data dummy way
        if ($this->id) {
            $categories = array_filter($categories, function ($cat) {
                return $cat["id"] == $this->id;
            });
        }
        if ($this->parentCategoryId) {
            $categories = array_filter($categories, function ($cat) {
                return $cat["parentCategoryId"] == $this->parentCategoryId;
            });
        }
        if ($this->name) {
            $categories = array_filter($categories, function ($cat) {
                return $cat["name"] == $this->name;
            });
        }
        if ($this->hasTools) {
            $categories = array_filter($categories, function ($cat) {
                return $cat["hasTools"] == $this->hasTools;
            });
        }

        //wrap up data the way we want it returned
        $rootCategories = array_filter($categories, function ($cat) { return $cat["parentCategoryId"] == null; });
        foreach($rootCategories as &$rootCat) {
            $this->prepareCategories($rootCat, $categories);
        }

        return $rootCategories;
    }
}

?>