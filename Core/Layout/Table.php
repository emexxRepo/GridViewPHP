<?php

namespace Core\Layout;
require_once 'TableLayout.php';

class Table extends TableLayout
{

    protected $table = '';
    protected $ths = array();
    protected $tds = array();
    protected $trs = array();
    protected $hiddenFields = array();

    /**
     * Table constructor.
     * @param int $width
     * @param int $height
     * @param int $border
     */

    public function __construct(int $width = 500, int $height = 500, int $border = 1)
    {
        $this->width = $width;
        $this->border = $border;
        $this->height = $height;
        $this->table = parent::TABLE;
    }

    /**
     * @param array $dataSource
     * @param bool $thead
     * @param array $ths
     */

    // Tabloyu oluşturduğumuz method
    public function build(array $dataSource = array(), array $hiddenFields = array(), $thead = false, $ths = array())
    {
        $this->hiddenFields = $hiddenFields;
        $this->startTable();
        if ($thead === true && !empty($ths)) {

            $this->setThead();

            foreach ($ths as $th => $value) {
                $this->setTh($value);
            }

            $this->endThead();

        }

        if (!empty($dataSource)) {

            $this->setTbody();

            foreach ($dataSource as $data => $value) {
                if (is_array($value) && !empty($value)) {
                    $this->setTr();
                    $newValue = $this->isHiddenValue($value);
                    foreach ($newValue as $key => $val) {
                        $this->setTd($val);

                    }
                    $this->endTr();
                }
            }

            $this->endTbody();
        }

        $this->endTable();

        return $this->table;
    }

    private function setThead(): void
    {
        $this->table .= parent::THEAD;
    }

    private function endThead(): void
    {
        $this->table .= parent::ENDTHEAD;
    }

    private function setTh(string $name): void
    {
        $this->ths[] = $name;
        $this->table .= parent::TH . $name . parent::ENDTD;
    }

    private function setTbody(): void
    {
        $this->table .= parent::TBODY;
    }

    private function endTbody(): void
    {
        $this->table .= parent::ENDTBODY;
    }

    private function setTr(): void
    {
        $this->table .= parent::TR;
    }

    private function endTr(): void
    {
        $this->table .= parent::ENDTR;
    }

    private function setTd(string $name): void
    {
        $this->tds[] = $name;
        $this->table .= parent::TD . $name . parent::ENDTD;
    }

    private function startTable(): void
    {
        $this->table .= '<table width = "' . $this->width . '" height = "' . $this->height . '" border="' . $this->border . '">';
    }

    private function endTable(): void
    {
        $this->table .= parent::ENDTABLE;
    }

    private function isHiddenValue(array $array): array
    {
        if (!empty($this->hiddenFields)) {

            foreach ($this->hiddenFields as $key => $val) {
                if (array_key_exists($val, $array)) {
                    unset($array[$val]);
                }
            }
        }

        return $array;
    }
}