<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema" exclude-result-prefixes="xs" version="2.0">
    <xsl:output method="xml" indent="yes" omit-xml-declaration="yes"/>

    <xsl:template match="/">
        <form class="quiz" id="quiz01"><xsl:apply-templates/></form>
    </xsl:template>

    <xsl:template match="fieldset">
        <xsl:element name="{local-name(.)}">
            <xsl:apply-templates select="legend"/>
            <xsl:apply-templates select="p"/>
            <ol>
                <xsl:apply-templates select="set"/>
            </ol>
        </xsl:element>
    </xsl:template>

    <xsl:template match="legend">
        <xsl:element name="{local-name(.)}">
            <xsl:apply-templates/>
        </xsl:element>
    </xsl:template>

    <xsl:template match="set">
        
            <li>
                <section>
                    <xsl:apply-templates
                        select="
                            q,
                            a"/>
                    <button type="button" disabled="disabled" class="check_answer"  >Sjekk svar</button>
                </section>
                <section class="explanation">
                    <h3>Forklaring</h3>
                    <xsl:apply-templates select="expl"/>
                </section>
            </li>
        
    </xsl:template>

    <xsl:template match="expl">
        <p>
            <xsl:choose>
                <xsl:when test="@res = 'incorrect'">
                    <xsl:attribute name="data-incorrect">data-incorrect</xsl:attribute>
                    <span>Beklager, det er feil.</span>
                </xsl:when>
                <xsl:when test="@res = 'correct'">
                    <xsl:attribute name="data-correct">data-correct</xsl:attribute>
                    <span>Riktig!</span>
                </xsl:when>
            </xsl:choose>
            <xsl:text> </xsl:text>
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="q">
        <p class="q">
            <xsl:apply-templates/>
        </p>
    </xsl:template>

    <xsl:template match="a">
        <xsl:variable name="y_n">
            <xsl:choose>
                <xsl:when test=". = 'Ja'">_yes</xsl:when>
                <xsl:when test=". = 'Nei'">_no</xsl:when>
            </xsl:choose>
        </xsl:variable>
        <label>
            <xsl:attribute name="for" select="concat(../@name, $y_n)"/>
            <xsl:choose>
                <xsl:when test="@res = 'incorrect'">
                    <xsl:attribute name="data-incorrect">data-incorrect</xsl:attribute>
                </xsl:when>
                <xsl:when test="@res = 'correct'">
                    <xsl:attribute name="data-correct">data-correct</xsl:attribute>
                </xsl:when>
            </xsl:choose>
            <input type="radio" id="{concat(../@name, $y_n)}" name="{../@name}"/>
            <xsl:value-of select="."/>
        </label>
    </xsl:template>
    
    <xsl:template match="em|strong|p">
        <xsl:element name="{local-name(.)}">
            <xsl:apply-templates/>
        </xsl:element>
    </xsl:template>
</xsl:stylesheet>
