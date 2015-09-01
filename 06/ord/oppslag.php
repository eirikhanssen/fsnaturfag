<?php 

    function lookupWord($proc, $xmlFile, $xslFile, $paramName, $paramVal){
        $proc->setSourceFile($xmlFile);
        $proc->setStylesheetFile($xslFile);
            
        if (isset($paramVal) && isset($paramName)) {
            $paramXdmVal = $proc->createXdmValue($paramVal);
            $proc->setParameter($paramName, $paramXdmVal);
        }

        $result = $proc->transformToString();               
        if($result != null) {               
            echo $result;
        } else {
           echo "Result is null";
        }
        $proc->clearParameters();
        $proc->clearProperties();
    }
    $xml = "xml/dict.xml";
    $xsl = "xsl/dict-c.xsl";
    $proc = new SaxonProcessor();
    $query_string  = '?'.$_SERVER['QUERY_STRING'];
    $param_name = "query_string";
    $param_value = $query_string;
    lookupWord($proc, $xml, $xsl, $param_name, $param_value);
?>
