<!--
  This is an XSLT stylesheet designed for Saxon-CE processor.
  For documentation about the Saxon-CE processor, see http://www.saxonica.com/ce/index.xml
  Developed by Eirik Hanssen, 2015
-->
<xsl:transform xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:prop="http://saxonica.com/ns/html-property"
	xmlns:style="http://saxonica.com/ns/html-style-property"
	xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:ixsl="http://saxonica.com/ns/interactiveXSLT"
	xmlns:js="http://saxonica.com/ns/globalJS" exclude-result-prefixes="xs prop"
	extension-element-prefixes="ixsl" version="2.0">
	
	<xsl:variable name="languages">
			<language name="ar">
				<xsl:sequence select="doc('ar-c06-long.xml')"/>
			</language>
			<language name="no">
				<xsl:sequence select="doc('no-c06-long.xml')"/>
			</language>
			<language name="so">
				<xsl:sequence select="doc('so-c06-long.xml')"/>
			</language>
			<language name="ti">
				<xsl:sequence select="doc('ti-c06-long.xml')"/>
			</language>
	</xsl:variable>
	
	<xsl:template name="start">
		<xsl:result-document href="#page-head" method="ixsl:append-content">
			<xsl:text> - tekst og lyd</xsl:text>
		</xsl:result-document>
		<xsl:result-document href="#primary_language_container" method="ixsl:append-content">
			<xsl:call-template name="getStory"/>
		</xsl:result-document>
	</xsl:template>
	
	<xsl:template name="getStory">
		<article>
			<xsl:if test="locale/@id">
				<xsl:attribute name="id" select="/locale/@id"/>
			</xsl:if>
			<xsl:if test="locale/@lang">
				<xsl:attribute name="lang" select="/locale/@lang"/>
			</xsl:if>
			<xsl:if test="locale/@dir">
				<xsl:attribute name="dir" select="/locale/@dir"/>
			</xsl:if>
			<xsl:apply-templates select="locale/audio"/>
			<xsl:apply-templates select="locale/text"/>
		</article>
	</xsl:template>
	
	<xsl:template match="locale">
		<article>
			<xsl:if test="./@id">
				<xsl:attribute name="id" select="./@id"/>
			</xsl:if>
			<xsl:if test="./@lang">
				<xsl:attribute name="lang" select="./@lang"/>
			</xsl:if>
			<xsl:if test="./@dir">
				<xsl:attribute name="dir" select="./@dir"/>
			</xsl:if>
			<xsl:apply-templates select="./audio"/>
			<xsl:apply-templates select="./text"/>
		</article>
	</xsl:template>
	
	<xsl:template match="text">
		<xsl:variable name="elementName" select="
			if (@html) 
			then @html 
			else 'div'"/>
		<xsl:element name="{$elementName}">
			<xsl:attribute name="id" select="concat(../@lang , '-' , @key)"/>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="h1|h2|h3|div|p">
		<xsl:element name="{local-name(.)}">
			<xsl:copy-of select="@*"/>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	
	<xsl:template match="audio">
		<audio controls="controls" preload="metadata">
			<xsl:attribute name="id" select="concat('audio-' , ../@id)"/>
			<xsl:apply-templates select="source"/>
			<xsl:text>Nettleseren din støtter ikke audio-elementet. Last ned lydfilen:</xsl:text> 
			<ul>
				<xsl:for-each select="source"><li><a href="{@src}"><xsl:value-of select="replace(@src , '.+/([^/]+)$' , '$1')"/></a><xsl:text> (</xsl:text><xsl:value-of select="replace(@type, '.+/([^/]+)$', '$1')"/><xsl:text> format)</xsl:text></li></xsl:for-each>
			</ul>
		</audio>
	</xsl:template>
	
	<xsl:template match="source">
		<source>
			<xsl:attribute name="src" select="@src"/>
			<xsl:attribute name="type" select="@type"/>
		</source>
	</xsl:template>
	
	<xsl:template match="input" mode="ixsl:onclick">
		<xsl:variable name="pri_or_sec_pattern" select="''"/>
		<xsl:variable name="element-id" select="@id"/>
		<!-- get language code from @id of input element -->
		<xsl:variable name="new-language" select="replace($element-id, '.*_([^_]+)$', '$1')"/>
		<xsl:variable name="pri_or_sec" select="replace($element-id, '^(primary|secondary).+', '$1')"/>
		<xsl:variable name="new-locale" select="$languages/language[@name=$new-language]"/>
		<xsl:variable name="insert_point" select="concat('#',$pri_or_sec,'_language_container')"/>
		<xsl:result-document href="{$insert_point}" method="ixsl:replace-content">
			<xsl:choose>
				<xsl:when test="$new-language != 'none'"><xsl:apply-templates select="$new-locale"/></xsl:when>
				<xsl:otherwise><p>Språk 2 har blitt deaktivert.</p></xsl:otherwise>
			</xsl:choose>
		</xsl:result-document>
	</xsl:template>
</xsl:transform>
