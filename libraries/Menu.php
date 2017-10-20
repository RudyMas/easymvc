<?php

namespace Library;

/**
 * Class Menu
 *
 * @author      Rudy Mas <rudy.mas@rmsoft.be>
 * @copyright   2017, rmsoft.be. (http://www.rmsoft.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.4.0
 * @package     Library
 */
class Menu
{
    private $menuData = [];

    /**
     * @param array $menuArray
     * @param string $menuText
     * @param string $menuUrl
     * @param string $menuClass
     */
    public function addMenu(array $menuArray, string $menuText, string $menuUrl, string $menuClass = '')
    {
        $menuOptions = $this->getIndexes($menuArray);
        $this->menuData[$menuOptions[0]][$menuOptions[1]][$menuOptions[2]][$menuOptions[3]][$menuOptions[4]][$menuOptions[5]][$menuOptions[6]][$menuOptions[7]][$menuOptions[8]][$menuOptions[9]]['url'] = $menuUrl;
        $this->menuData[$menuOptions[0]][$menuOptions[1]][$menuOptions[2]][$menuOptions[3]][$menuOptions[4]][$menuOptions[5]][$menuOptions[6]][$menuOptions[7]][$menuOptions[8]][$menuOptions[9]]['text'] = $menuText;
        $this->menuData[$menuOptions[0]][$menuOptions[1]][$menuOptions[2]][$menuOptions[3]][$menuOptions[4]][$menuOptions[5]][$menuOptions[6]][$menuOptions[7]][$menuOptions[8]][$menuOptions[9]]['class'] = $menuClass;
    }

    /**
     * @param array $arrayMenu
     * @param array $args
     * @param string $id
     * @param string $class
     * @return string
     */
    public function createMenu(array $arrayMenu = [], array $args = [], string $id = '', string $class = ''): string
    {
        $output = '<div id=' . $id . '>';
        $output .= '<div id="mainMenu">';
        $output .= $this->createMainMenu($arrayMenu, $args, '', $class);
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    /**
     * @param array $arrayMenu
     * @param array $args
     * @param string $id
     * @param string $class
     * @param bool $isOnline
     * @return string
     */
    public function createMenuWithLogin(array $arrayMenu = [], array $args = [], string $id = '', string $class = '', bool $isOnline = false): string
    {
        $output = '<div id=' . $id . '>';
//        $output .= '<div id="loginMenu">';
//        $output .= $this->createLoginMenu($isOnline);
//        $output .= '</div>';
        $output .= '<div id="mainMenu">';
        $output .= $this->createMainMenu($arrayMenu, $args, '', $class);
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    /**
     * @param int $pageNumber
     * @param int $items
     * @param int $itemsPerPage
     * @param string $pageUrl
     * @param string $menuSize
     * @return string
     */
    public function createPagination(int $pageNumber, int $items, int $itemsPerPage, string $pageUrl, string $menuSize = ''): string
    {
        $numberOfPages = ceil($items / $itemsPerPage);

        if ($menuSize == 'lg') {
            $output = '<ul class="pagination pagination-lg">';
        } elseif ($menuSize == 'sm') {
            $output = '<ul class="pagination pagination-sm">';
        } else {
            $output = '<ul class="pagination">';
        }

        if ($numberOfPages == 1) {
            return '';
        } else {
            if ($pageNumber == 1) {
                $output .= '<li class="active"><span>1</span></li>';
            } else {
                $output .= '<li><a href="' . BASE_URL . $pageUrl . '/1">1</a></li>';
            }

            if ($numberOfPages > 2) {
                if ($numberOfPages > 15) {
                    if ($pageNumber < 11) {
                        $output .= '<li class="disabled"><span>&laquo;</span></li>';
                    } else {
                        $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . ($pageNumber - 10) . '">&laquo;</a></li>';
                    }
                }

                if ($numberOfPages > 5) {
                    if ($pageNumber == 1) {
                        $output .= '<li class="disabled"><span>&lsaquo;</span></li>';
                    } else {
                        $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . ($pageNumber - 1) . '">&lsaquo;</a></li>';
                    }
                }

                if ($numberOfPages < 8) {
                    $xStart = 2;
                    $xStop = $numberOfPages;
                } elseif ($pageNumber < 5) {
                    $xStart = 2;
                    $xStop = 7;
                } elseif ($pageNumber > ($numberOfPages - 4)) {
                    $xStart = $numberOfPages - 5;
                    $xStop = $numberOfPages;
                } else {
                    $xStart = $pageNumber - 2;
                    $xStop = $pageNumber + 3;
                }
                for ($x = $xStart; $x < $xStop; $x++) {
                    if ($pageNumber == $x) {
                        $output .= '<li class="active"><span>' . $x . '</span></li>';
                    } else {
                        $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . $x . '">' . $x . '</a></li>';
                    }
                }

                if ($numberOfPages > 5) {
                    if ($pageNumber == $numberOfPages) {
                        $output .= '<li class="disabled"><span>&rsaquo;</span></li>';
                    } else {
                        $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . ($pageNumber + 1) . '">&rsaquo;</a></li>';
                    }
                }

                if ($numberOfPages > 15) {
                    if ($pageNumber > $numberOfPages - 10) {
                        $output .= '<li class="disabled"><span>&raquo;</span></li>';
                    } else {
                        $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . ($pageNumber + 10) . '">&raquo;</a></li>';
                    }
                }
            }

            if ($pageNumber == $numberOfPages) {
                $output .= '<li class="active"><span>' . $numberOfPages . '</span></li>';
            } else {
                $output .= '<li><a href="' . BASE_URL . $pageUrl . '/' . $numberOfPages . '">' . $numberOfPages . '</a></li>';
            }
        }

        $output .= '</ul>';

        return $output;
    }

    /**
     * @param array $arrayMenu
     * @param array $args
     * @param string $id
     * @param string $class
     * @return string
     */
    private function createMainMenu(array $arrayMenu = [], array $args = [], string $id = '', string $class = ''): string
    {
        $numberArgs = count($args);
        if (empty($arrayMenu)) $arrayMenu = $this->menuData;

        $output = '';
        $remove = ['none', 'None', 'NONE'];

        $arrayKey = array_keys($arrayMenu);
        $arrayKey = array_diff($arrayKey, $remove);
        $arrayKey = array_values($arrayKey);
        $arrayCount = count($arrayKey);

        $output .= '<ul';
        if ($id <> '') $output .= ' id="' . $id . '"';
        if ($class <> '') $output .= ' class="' . $class . '"';
        $output .= '>';

        if (isset($_SESSION['numberOfMenuItems']) && $_SESSION['numberOfMenuItems'] < $arrayCount) {
            $numberExtraMenus = ceil($arrayCount / $_SESSION['numberOfMenuItems']);
            for ($x = 0; $x < $numberExtraMenus; $x++) {
                $output .= '<li>';
                $output .= '<a class="extraMenu">&lt;' . ($x + 1) . '&gt;</a>';
                $output .= '<ul class="extraMenu">';
                for ($y = $x * $_SESSION['numberOfMenuItems']; $y < ($_SESSION['numberOfMenuItems'] * $x) + $_SESSION['numberOfMenuItems'] && $y < $arrayCount; $y++) {
                    $menuItem = $arrayKey[$y];
                    $this->createSubMenu($args, $output, $numberArgs, $menuItem, $arrayMenu, $remove);
                }
                $output .= '</ul>';
                $output .= '</li>';
            }
        } else {
            foreach ($arrayKey as $menuItem) {
                $this->createSubMenu($args, $output, $numberArgs, $menuItem, $arrayMenu, $remove);
            }
        }

        $output .= '</ul>';
        return $output;
    }

    /**
     * @param array $args
     * @param string $output
     * @param int $numberArgs
     * @param string $menuItem
     * @param array $arrayMenu
     * @param array $remove
     */
    private function createSubMenu(array &$args, string &$output, int $numberArgs, string $menuItem, array $arrayMenu, array $remove)
    {
        $args[$numberArgs] = $menuItem;
        $output .= '<li>';
        list($linkOutput, $linkClass) = $this->createMenuLink($args);
        $output .= $linkOutput;
        if (is_array($arrayMenu[$menuItem])) {
            $arrayKeyChild = array_keys($arrayMenu[$menuItem]);
            $arrayKeyChild = array_diff($arrayKeyChild, $remove);
            $arrayCountChild = count($arrayKeyChild);
            if ($arrayCountChild > 0) {
                $output .= $this->createMainMenu($arrayMenu[$menuItem], $args, '', $linkClass);
            }
        }
        $output .= '</li>';
    }

    /**
     * @param array $args
     * @return array
     */
    private function createMenuLink(array $args): array
    {
        $arguments = $this->getIndexes($args);
        $url = $this->menuData[$arguments[0]][$arguments[1]][$arguments[2]][$arguments[3]][$arguments[4]][$arguments[5]][$arguments[6]][$arguments[7]][$arguments[8]][$arguments[9]]['url'];
        $text = $this->menuData[$arguments[0]][$arguments[1]][$arguments[2]][$arguments[3]][$arguments[4]][$arguments[5]][$arguments[6]][$arguments[7]][$arguments[8]][$arguments[9]]['text'];
        $class = $this->menuData[$arguments[0]][$arguments[1]][$arguments[2]][$arguments[3]][$arguments[4]][$arguments[5]][$arguments[6]][$arguments[7]][$arguments[8]][$arguments[9]]['class'];

        $output = '<a href="' . BASE_URL . $url . '"';
        if ($class <> '') $output .= ' class="' . $class . '"';
        $output .= '>' . $text . '</a>';

        return [$output, $class];
    }

    /**
     * @param bool $isOnline
     * @return string
     */
    private function createLoginMenu(bool $isOnline): string
    {
        $output = '<ul>';
        if ($isOnline) {
            $output .= '<li><a href="' . BASE_URL . '/user/account">Account</a>';
            $output .= '<ul>';
            $output .= '<li><a href="' . BASE_URL . '/onderhoud">Onderhoud Foto\'s</a></li>';
            $output .= '</ul></li>';
            $output .= '<li><a href="' . BASE_URL . '/user/logout">Afmelden</a></li>';
        } else {
            $output .= '<li><a href="' . BASE_URL . '/user/login">Aanmelden</a></li>';
            $output .= '<li><a href="' . BASE_URL . '/user/register">Registreren</a></li>';
        }
        $output .= '</ul>';
        return $output;
    }

    /**
     * @param array $args
     * @return array
     */
    private function getIndexes(array $args): array
    {
        $arguments = ['none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none'];
        for ($x = 0; $x < count($args); $x++) {
            if (isset($args[$x])) $arguments[$x] = $args[$x];
        }
        return $arguments;
    }
}

/** End of File: Menu.php **/