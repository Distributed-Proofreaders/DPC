<?PHP
// This file allows us (PGDP) to use DifferenceEngine.php from WikiMedia
// without any content modification, which should make it easier
// to upgrade when WikiMedia publishes a new version of the file.
//
// When upgrading the version of DifferenceEngine.php, ensure that the
// stylesheet doesn't also need to be upgraded.
//
// Note that the WikiMedia version of the file has a .php extension
// whereas the PGDP version has an .inc extension.

// DifferenceEngine lifted from WikiMedia:
//   includes/DifferenceEngine.php rev 33518
include_once("DifferenceEngine.php");

// non-object global variables
$wgExternalDiffEngine = FALSE;

// wrapper function for the primary DifferenceEngine interface
class DifferenceEngineWrapper extends DifferenceEngine {
    function __construct() {
        parent::__construct();
    }

    public function showDiff($L_text, $R_text, $L_label, $R_label) {
        $this->setText($L_text, $R_text);
        parent::showDiff($L_label, $R_label);
    }

    public function getMultiNotice() {
        return '';
    }

    public function localiseLineNumbersCb($line_numbers) {
        return sprintf(_("Line %d"), $line_numbers[1]);
    }
}

// stub functions
function wfDebug($string) {
}

function wfProfileIn($string) {
}

function wfProfileOut($string) {
}

function wfIncrStats($string) {
}

// stub classes and global instances
class OutputPage {
    function addHTML($text) {
        echo $text;
    }

    function addWikiMsg($text) {
    }

    function addStyle($text) {
    }

    function addScript($text) {
    }
}

$wgOut = new Outputpage();

class ContLang {
    function segmentForDiff($string) {
        return $string;
    }

    function unsegmentForDiff($string) {
        return $string;
    }
}

$wgContLang = new ContLang;

// DifferenceEngine uses the Xml::tags function
// so we will define a rough simulation to satisfy
// the requirements
if(!class_exists("Xml")) {
    class Xml {
        function tags( $tagName, $className, $contents ) {
            return "<$tagName>$contents</$tagName>";
        }
    }
}

// stylesheet lifted from WikiMedia:
//   skins/common/diff.css rev 33518
// and customized for PGDP
// function get_DifferenceEngine_stylesheet() {
//     return "
// table.diff, td.diff-otitle, td.diff-ntitle {
//     background-color: white;
// }
// td.diff-otitle,
// td.diff-ntitle {
//     text-align: center;
//     /* added for PGDP */
//     font-weight: bold;
// }
// td.diff-marker {
//     text-align: right;
// }
// .rtl td.diff-marker {
//     text-align: left;
// }
// td.diff-lineno {
//     font-weight: bold;
// }
// td.diff-addedline {
//     background: #cfc;
// }
// td.diff-deletedline {
//     background: #ffa;
// }
// td.diff-context {
//     background: #eee;
// }
// /* added for PGDP */
// td.diff-marker,
// td.diff-addedline,
// td.diff-deletedline,
// td.diff-context {
//     font-family: DPCustomMono2, monospace;
//     font-size: smaller;
// }
// .diffchange {
//     color: red;
//     font-weight: bold;
//     text-decoration: none;
//     white-space: pre-wrap;
//     white-space: -moz-pre-wrap;
// }
// .diffchange-inline {
//     border: 1px dotted red;
// }
// 
// table.diff {
//     border: none;
//     width: 98%;
//     border-spacing: 4px;
//     
//     /* Fixed layout is required to ensure that cells containing long URLs
//        don't widen in Safari, Internet Explorer, or iCab */
//     table-layout: fixed;
// }
// table.diff td {
//     padding: 0;
// }
// table.diff col.diff-marker {
//     width: 2%;
// }
// table.diff col.diff-content {
//     width: 48%;
// }
// table.diff td div {
//     /* Force-wrap very long lines such as URLs or page-widening char strings.
//        CSS 3 draft..., but Gecko doesn't support it yet:
//        https://bugzilla.mozilla.org/show_bug.cgi?id=99457 */
//     word-wrap: break-word;
//     
//     /* As fallback, scrollbars will be added for very wide cells
//        instead of text overflowing or widening */
//     overflow: auto;
//     
//     /* The above rule breaks on very old versions of Mozilla due
//        to a bug which collapses the table cells to a single line.
//        
//        In Mozilla 1.1 and below with JavaScript enabled, the rule
//        will be overridden with this by diff.js; wide cell contents
//        then spill horizontally without widening the rest of the
//        table: */
//     /* overflow: visible; */
// }
// ";
// }

// vim: sw=4 ts=4 expandtab
?>
