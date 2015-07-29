<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:hfw="http://www.hfw.no/ns"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs hfw"
    version="2.0">
    
    <xsl:variable name="timings" select="doc('../06/smil/ti-short.smil')/par"/>

    <xsl:function name="hfw:padNumber" as="xs:string">
        <xsl:param name="num" as="xs:integer"/>
        <xsl:choose>
            <xsl:when test="$num &lt; 10">
                <xsl:value-of select="concat('0', xs:string($num))"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:value-of select="xs:string($num)"/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:function>

    <xsl:template match="/ | locale">
        <xsl:apply-templates/>
<!--        <xsl:sequence select="$timings"/>-->
    </xsl:template>

    <xsl:template match="slide">
        <xsl:variable name="firstKey" select="text[1]/@key"/>
        <xsl:variable name="lastKey" select="text[last()]/@key"/>
        <xsl:variable name="slideNum" select="hfw:padNumber((count(preceding::slide)+1))"/>
        <xsl:variable name="begin" select="$timings/item[@select eq $firstKey]/@begin"/>
        <xsl:variable name="end" select="$timings/item[@select eq $lastKey]/@end"/>
        <item>
            <xsl:attribute name="select" select="concat('slide-',ancestor::locale[1]/@lang,$slideNum)"/>
            <xsl:attribute name="begin" select="$begin"/>
            <xsl:attribute name="end" select="$end"/>
        </item>
    </xsl:template>
</xsl:stylesheet>