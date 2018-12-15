<?php
namespace Core\Layout;
abstract class TableLayout
{
    //SET TABLE ELEMENT PROPERTIES
    protected const TABLE = '';
    protected const TR = '<tr>';
    protected const TD = '<td>';
    protected const TH = '<th>';
    protected const TBODY = '<tbody>';
    protected const THEAD = '<thead>';

    protected const ENDTABLE = '</table>';
    protected const ENDTR = '</tr>';
    protected const ENDTD = '</td>';
    protected const ENDTH = '</th>';
    protected const ENDTBODY = '</tbody>';
    protected const ENDTHEAD = '</thead>';

    protected $height = 0;
    protected $width  = 0;
    protected $border = 1;

}