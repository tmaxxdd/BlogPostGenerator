<?php

class ComponentsGenerator
{

    public function getComponentsViews($array)
    {
        $view = "";

        foreach ($array as $key => $value) {
            switch ($value) {
                case "header":
                    $view = $view . $this->getHeaderView($key);
                    break;
                case "text":
                    $view = $view . $this->getTextView($key);
                    break;
                case "image":
                    $view = $view . $this->getImageView($key);
                    break;
                case "code":
                    $view = $view . $this->getCodeView($key);
                    break;
                case "link":
                    $view = $view . $this->getLinkView($key);
                    break;
                case "table":
                    $view = $view . $this->getTableView($key);
                    break;
            }
        }

        return $view;
    }

    private function getHeaderView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Header:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . '<input class="component header" type="text" id="component-' . $position . '" value=""/>';
    }

    private function getTextView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Text:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . '<textarea class="component text" type="text" id="component-' . $position . '"></textarea>';
    }

    private function getImageView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Photo:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . '<input class="component image" type="text" id="component-' . $position . '" value=""/>';
    }

    private function getCodeView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Code:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . '<input class="component code" type="text" id="component-' . $position . '" value=""/>';
    }

    private function getLinkView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Link:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . "<br><br>"
            . '<div class="component link row" id="component-' . $position . '">'
            . '<div class="input-field col s6">'
            . '<input placeholder="Link" id="link_href" type="text">'
            . '</div>'
            . '<div class="input-field col s6">'
            . '<input placeholder="Name" id="link_name" type="text">'
            . '</div>'
            . '</div>';
    }

    private function getTableView($position)
    {
        return
            '<p>Id = ' . $position . '</p>'
            . '<p>Table:</p>'
            . '<a onclick="deleteComponentAt(' . $position . ');" class="waves-effect waves-teal btn-flat right"><i class="material-icons left">close</i></a>'
            . "<br><br>"
            . '<div class="component table chips chips-initial" id="component-' . $position . '"></div>';
    }

}
