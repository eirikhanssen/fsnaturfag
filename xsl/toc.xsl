<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    
    <xsl:output method="xml" indent="yes"></xsl:output>

    <xsl:template match="/">
        <xsl:apply-templates select="//main/section"/>
    </xsl:template>

    <xsl:template match="main/section">
        <ul>
            <xsl:apply-templates select="section|h1|h2|h3|h4|h5|h6"/>
        </ul>
    </xsl:template>
    
    <xsl:template match="section">
        <li>
            <ul>
                <xsl:apply-templates select="section|h1|h2|h3|h4|h5|h6"/>
            </ul>
        </li>
    </xsl:template>

    <xsl:template match="h1|h2|h3|h4|h5|h6">
        <li>
            <a href="{concat('#',@id)}"><xsl:value-of select="."/></a>
        </li>
    </xsl:template>

</xsl:stylesheet>
