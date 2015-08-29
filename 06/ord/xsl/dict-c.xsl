<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:prop="http://saxonica.com/ns/html-property"
    xmlns:style="http://saxonica.com/ns/html-style-property"
    xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:ixsl="http://saxonica.com/ns/interactiveXSLT"
    xmlns:hfw="http://www.hfw.no/ns" xmlns:s="http://www.w3.org/ns/SMIL"
    xmlns:js="http://saxonica.com/ns/globalJS" exclude-result-prefixes="xsl prop style xs hfw s js"
    extension-element-prefixes="ixsl" version="2.0">

    <xsl:output method="xhtml" indent="yes" omit-xml-declaration="yes"/>

    <!-- TODO: get word and language as a parameter from get variables -->
    <!-- example link: dict.html?w=earth&l=no -->
    <!-- if there is no word/language match display notice -->
    <xsl:param name="query_string"><xsl:text>?l=no&amp;w=earth</xsl:text></xsl:param>

    <xsl:variable name="query_params">
        <xsl:if test="$query_string != ''">
            <xsl:for-each select="tokenize(replace($query_string , '^[?](.+)$' , '$1'),'&amp;')">
                <var name="{replace(.,'^(.+?)=(.+?)$','$1')}"
                    val="{replace(.,'^(.+?)=(.+?)$','$2')}"/>
            </xsl:for-each>
        </xsl:if>
    </xsl:variable>
    
    <xsl:variable name="lang" select="$query_params/var[@name='w']/@val"/>
    <xsl:variable name="word" select="$query_params/var[@name='l']/@val"/>

    <xsl:template match="/">
        <html lang="no">
            <head id="page-head">
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title id="page-title">Ordliste</title>
                <link id="timesheet" href="no.dict.earth.smil" rel="timesheet" type="application/smil+xml" />
                <script src="../../js/timesheets.min.js"></script>
            </head>
            
            <body id="body">
                <main id="main">
            <xsl:choose>
                <xsl:when test="$query_params/var">
                    <!--<h2>params:</h2>
                    <xsl:for-each select="$query_params/var">
                        <p><xsl:value-of select="@name"/> = <xsl:value-of select="@val"/></p>
                    </xsl:for-each>-->
                    <xsl:choose>
                        
                        <xsl:when test="(count($query_params/var[@name='w']) eq 1) and (count($query_params/var[@name='l']) eq 1)">
                            <xsl:variable name="word" select="$query_params/var[@name='w']/@val"/>
                            <xsl:variable name="lang" select="$query_params/var[@name='l']/@val"/>
                            <!--<p>one word and one locale ok</p>-->
                             <!--check if entry exists, and get it if it does--> 
                            <xsl:choose>
                                <!-- test if entry exists -->
                                <xsl:when test="locales/locale[@lang = $lang]/entry[@word = $word]">
                                    <!--<p> - Test OK - </p>
                                    <p>lang: <xsl:value-of select="$lang"/></p>
                                    <p>word: <xsl:value-of select="$word"/></p>-->
                                    <xsl:call-template name="getEntry"/>
                                    <!--<xsl:call-template name="smilTimings"/>-->
                                </xsl:when>
                                <xsl:when test="not(locales/locale[@lang = $lang])">
                                    <h2>Ordliste – feilmelding</h2>
                                    <p>Beklager, språket «<strong><xsl:value-of select="$lang"/></strong>» er ikke lagt til/støttet enda.</p>
                                </xsl:when>
                                <xsl:when test="locales/locale[@lang = $lang] and not(locales/locale[@lang = $lang]/entry[@word = $word])">
                                    <h2>Ordliste – feilmelding</h2>
                                    <p>Beklager, ordet «<strong><xsl:value-of select="$word"/></strong>» er ikke ført opp i ordlisten for språket «<strong><xsl:value-of select="$lang"/></strong>» enda.</p>
                                </xsl:when>
                                <xsl:otherwise>
                                    <h2>Ordliste – feilmelding</h2>
                                    <p>Beklager, her skjedde det en feil</p>
                                </xsl:otherwise>
                            </xsl:choose>
                        </xsl:when>
                    </xsl:choose>
                    
                </xsl:when>
                <xsl:otherwise>
                    <h2>Ordliste — feilmelding</h2>
                    <p><strong>NB: </strong>Ingen ord/språk angitt</p>
                    <p>Ord/Språk angis i slutten av url-strengen f.eks slik: <code>http://(...)/ord/dict.html?w=earth&amp;lang=no</code></p>
                    <p>variablen «w» svarer til ordet (word) og variabelen «l» svarer til språket (language)</p>
                </xsl:otherwise>
            </xsl:choose>
                </main>
            </body>
        </html>
    </xsl:template>

    <xsl:template name="getEntry">
        <article>
            <xsl:attribute name="id" select="concat('dict-', locales/locale/@lang)"/>
            <xsl:apply-templates/>
        </article>
    </xsl:template>
<!--
    <xsl:template name="smilTimings">
        <xsl:result-document href="#page-head" method="ixsl:append-content">
            <link id="timesheet" href="{concat('dict-' , 'no' , '-' , 'earth' , '.smil')}" rel="timesheet" type="application/smil+xml"/>
        </xsl:result-document>
        <xsl:result-document href="#body" method="ixsl:append-content">
            <script src="../../js/timesheets.min.js"></script>
        </xsl:result-document>
    </xsl:template>-->


    <xsl:template match="audio">
        <xsl:element name="{local-name()}">
            <xsl:attribute name="id" select="concat('audio-' , ancestor::locale/@lang)"/>
            <xsl:attribute name="controls" select="'controls'"/>
            <xsl:apply-templates/>
            <p>Nettleseren støtter ikke html5 audio-elementet. Last ned lydfilen her:</p>
            <ul>
                <xsl:for-each select="source">
                    <li><a href="{@src}"><xsl:value-of select="replace(@src,'^.+?[/]([^/]+)$','$1')"/></a></li>
                </xsl:for-each>
            </ul>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="source">
        <xsl:element name="{local-name()}">
            <xsl:copy-of select="@*"/>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="term">
        <xsl:element name="{@t}">
            <xsl:attribute name="id" select="@id"/>
            <xsl:apply-templates/>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="img">
        <xsl:element name="{local-name()}">
            <xsl:copy-of select="@*"/>
            <xsl:apply-templates/>
        </xsl:element>
    </xsl:template>
    
    <xsl:template match="item"/>

</xsl:stylesheet>
