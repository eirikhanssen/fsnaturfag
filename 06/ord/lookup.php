<?php 
//echo "testing...";
        /* simple example to show transforming to a string */
            
    function lookupWord($proc, $xmlFile, $xslFile, $paramName, $paramVal){
        $proc->setSourceFile($xmlFile);
        $proc->setStylesheetFile($xslFile);
  	    //$proc->setParameter($paramName, $proc->createXdmValue($paramVal));          
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
		
    //$version = $proc->version();
    //echo 'Saxon Processor version: '.$version;
    //echo '<br/>';        
    lookupWord($proc, $xml, $xsl, $param_name, $param_value);
    //echo $query_string;
?>
