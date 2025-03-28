<?php

namespace Inilim\Tool\Method\Str;

/**
 * @return null|string
 */
function getEntByNcr(string $ncr)
{
    if (
        \preg_match('#^\&\#\d{2,4}\;$#', $ncr) === false
    ) {
        return null;
    }

    switch ($ncr) {
        case '&#34;':
            $v = '&quot;';
            break;
        case '&#38;':
            $v = '&amp;';
            break;
        case '&#60;':
            $v = '&lt;';
            break;
        case '&#62;':
            $v = '&gt;';
            break;
        case '&#124;':
            $v = '|';
            break;
        case '&#160;':
            $v = '&nbsp;';
            break;
        case '&#161;':
            $v = '&iexcl;';
            break;
        case '&#162;':
            $v = '&cent;';
            break;
        case '&#163;':
            $v = '&pound;';
            break;
        case '&#164;':
            $v = '&curren;';
            break;
        case '&#165;':
            $v = '&yen;';
            break;
        case '&#166;':
            $v = '&brvbar;';
            break;
        case '&#166;':
            $v = '&brkbar;';
            break;
        case '&#167;':
            $v = '&sect;';
            break;
        case '&#168;':
            $v = '&uml;';
            break;
        case '&#168;':
            $v = '&die;';
            break;
        case '&#169;':
            $v = '&copy;';
            break;
        case '&#170;':
            $v = '&ordf;';
            break;
        case '&#171;':
            $v = '&laquo;';
            break;
        case '&#172;':
            $v = '&not;';
            break;
        case '&#173;':
            $v = '&shy;';
            break;
        case '&#174;':
            $v = '&reg;';
            break;
        case '&#175;':
            $v = '&macr;';
            break;
        case '&#175;':
            $v = '&hibar;';
            break;
        case '&#176;':
            $v = '&deg;';
            break;
        case '&#177;':
            $v = '&plusmn;';
            break;
        case '&#178;':
            $v = '&sup2;';
            break;
        case '&#179;':
            $v = '&sup3;';
            break;
        case '&#180;':
            $v = '&acute;';
            break;
        case '&#181;':
            $v = '&micro;';
            break;
        case '&#182;':
            $v = '&para;';
            break;
        case '&#183;':
            $v = '&middot;';
            break;
        case '&#184;':
            $v = '&cedil;';
            break;
        case '&#185;':
            $v = '&sup1;';
            break;
        case '&#186;':
            $v = '&ordm;';
            break;
        case '&#187;':
            $v = '&raquo;';
            break;
        case '&#188;':
            $v = '&frac14;';
            break;
        case '&#189;':
            $v = '&frac12;';
            break;
        case '&#190;':
            $v = '&frac34;';
            break;
        case '&#191;':
            $v = '&iquest;';
            break;
        case '&#192;':
            $v = '&Agrave;';
            break;
        case '&#193;':
            $v = '&Aacute;';
            break;
        case '&#194;':
            $v = '&Acirc;';
            break;
        case '&#195;':
            $v = '&Atilde;';
            break;
        case '&#196;':
            $v = '&Auml;';
            break;
        case '&#197;':
            $v = '&Aring;';
            break;
        case '&#198;':
            $v = '&AElig;';
            break;
        case '&#199;':
            $v = '&Ccedil;';
            break;
        case '&#200;':
            $v = '&Egrave;';
            break;
        case '&#201;':
            $v = '&Eacute;';
            break;
        case '&#202;':
            $v = '&Ecirc;';
            break;
        case '&#203;':
            $v = '&Euml;';
            break;
        case '&#204;':
            $v = '&Igrave;';
            break;
        case '&#205;':
            $v = '&Iacute;';
            break;
        case '&#206;':
            $v = '&Icirc;';
            break;
        case '&#207;':
            $v = '&Iuml;';
            break;
        case '&#208;':
            $v = '&ETH;';
            break;
        case '&#209;':
            $v = '&Ntilde;';
            break;
        case '&#210;':
            $v = '&Ograve;';
            break;
        case '&#211;':
            $v = '&Oacute;';
            break;
        case '&#212;':
            $v = '&Ocirc;';
            break;
        case '&#213;':
            $v = '&Otilde;';
            break;
        case '&#214;':
            $v = '&Ouml;';
            break;
        case '&#215;':
            $v = '&times;';
            break;
        case '&#216;':
            $v = '&Oslash;';
            break;
        case '&#217;':
            $v = '&Ugrave;';
            break;
        case '&#218;':
            $v = '&Uacute;';
            break;
        case '&#219;':
            $v = '&Ucirc;';
            break;
        case '&#220;':
            $v = '&Uuml;';
            break;
        case '&#221;':
            $v = '&Yacute;';
            break;
        case '&#222;':
            $v = '&THORN;';
            break;
        case '&#223;':
            $v = '&szlig;';
            break;
        case '&#224;':
            $v = '&agrave;';
            break;
        case '&#225;':
            $v = '&aacute;';
            break;
        case '&#226;':
            $v = '&acirc;';
            break;
        case '&#227;':
            $v = '&atilde;';
            break;
        case '&#228;':
            $v = '&auml;';
            break;
        case '&#229;':
            $v = '&aring;';
            break;
        case '&#230;':
            $v = '&aelig;';
            break;
        case '&#231;':
            $v = '&ccedil;';
            break;
        case '&#232;':
            $v = '&egrave;';
            break;
        case '&#233;':
            $v = '&eacute;';
            break;
        case '&#234;':
            $v = '&ecirc;';
            break;
        case '&#235;':
            $v = '&euml;';
            break;
        case '&#236;':
            $v = '&igrave;';
            break;
        case '&#237;':
            $v = '&iacute;';
            break;
        case '&#238;':
            $v = '&icirc;';
            break;
        case '&#239;':
            $v = '&iuml;';
            break;
        case '&#240;':
            $v = '&eth;';
            break;
        case '&#241;':
            $v = '&ntilde;';
            break;
        case '&#242;':
            $v = '&ograve;';
            break;
        case '&#243;':
            $v = '&oacute;';
            break;
        case '&#244;':
            $v = '&ocirc;';
            break;
        case '&#245;':
            $v = '&otilde;';
            break;
        case '&#246;':
            $v = '&ouml;';
            break;
        case '&#247;':
            $v = '&divide;';
            break;
        case '&#248;':
            $v = '&oslash;';
            break;
        case '&#249;':
            $v = '&ugrave;';
            break;
        case '&#250;':
            $v = '&uacute;';
            break;
        case '&#251;':
            $v = '&ucirc;';
            break;
        case '&#252;':
            $v = '&uuml;';
            break;
        case '&#253;':
            $v = '&yacute;';
            break;
        case '&#254;':
            $v = '&thorn;';
            break;
        case '&#255;':
            $v = '&yuml;';
            break;
        case '&#338;':
            $v = '&OElig;';
            break;
        case '&#339;':
            $v = '&oelig;';
            break;
        case '&#352;':
            $v = '&Scaron;';
            break;
        case '&#353;':
            $v = '&scaron;';
            break;
        case '&#376;':
            $v = '&Yuml;';
            break;
        case '&#402;':
            $v = '&fnof;';
            break;
        case '&#710;':
            $v = '&circ;';
            break;
        case '&#732;':
            $v = '&tilde;';
            break;
        case '&#913;':
            $v = '&Alpha;';
            break;
        case '&#914;':
            $v = '&Beta;';
            break;
        case '&#915;':
            $v = '&Gamma;';
            break;
        case '&#916;':
            $v = '&Delta;';
            break;
        case '&#917;':
            $v = '&Epsilon;';
            break;
        case '&#918;':
            $v = '&Zeta;';
            break;
        case '&#919;':
            $v = '&Eta;';
            break;
        case '&#920;':
            $v = '&Theta;';
            break;
        case '&#921;':
            $v = '&Iota;';
            break;
        case '&#922;':
            $v = '&Kappa;';
            break;
        case '&#923;':
            $v = '&Lambda;';
            break;
        case '&#924;':
            $v = '&Mu;';
            break;
        case '&#925;':
            $v = '&Nu;';
            break;
        case '&#926;':
            $v = '&Xi;';
            break;
        case '&#927;':
            $v = '&Omicron;';
            break;
        case '&#928;':
            $v = '&Pi;';
            break;
        case '&#929;':
            $v = '&Rho;';
            break;
        case '&#931;':
            $v = '&Sigma;';
            break;
        case '&#932;':
            $v = '&Tau;';
            break;
        case '&#933;':
            $v = '&Upsilon;';
            break;
        case '&#934;':
            $v = '&Phi;';
            break;
        case '&#935;':
            $v = '&Chi;';
            break;
        case '&#936;':
            $v = '&Psi;';
            break;
        case '&#937;':
            $v = '&Omega;';
            break;
        case '&#945;':
            $v = '&alpha;';
            break;
        case '&#946;':
            $v = '&beta;';
            break;
        case '&#947;':
            $v = '&gamma;';
            break;
        case '&#948;':
            $v = '&delta;';
            break;
        case '&#949;':
            $v = '&epsilon;';
            break;
        case '&#950;':
            $v = '&zeta;';
            break;
        case '&#951;':
            $v = '&eta;';
            break;
        case '&#952;':
            $v = '&theta;';
            break;
        case '&#953;':
            $v = '&iota;';
            break;
        case '&#954;':
            $v = '&kappa;';
            break;
        case '&#955;':
            $v = '&lambda;';
            break;
        case '&#956;':
            $v = '&mu;';
            break;
        case '&#957;':
            $v = '&nu;';
            break;
        case '&#958;':
            $v = '&xi;';
            break;
        case '&#959;':
            $v = '&omicron;';
            break;
        case '&#960;':
            $v = '&pi;';
            break;
        case '&#961;':
            $v = '&rho;';
            break;
        case '&#962;':
            $v = '&sigmaf;';
            break;
        case '&#963;':
            $v = '&sigma;';
            break;
        case '&#964;':
            $v = '&tau;';
            break;
        case '&#965;':
            $v = '&upsilon;';
            break;
        case '&#966;':
            $v = '&phi;';
            break;
        case '&#967;':
            $v = '&chi;';
            break;
        case '&#968;':
            $v = '&psi;';
            break;
        case '&#969;':
            $v = '&omega;';
            break;
        case '&#977;':
            $v = '&thetasym;';
            break;
        case '&#978;':
            $v = '&upsih;';
            break;
        case '&#982;':
            $v = '&piv;';
            break;
        case '&#8194;':
            $v = '&ensp;';
            break;
        case '&#8195;':
            $v = '&emsp;';
            break;
        case '&#8201;':
            $v = '&thinsp;';
            break;
        case '&#8204;':
            $v = '&zwnj;';
            break;
        case '&#8205;':
            $v = '&zwj;';
            break;
        case '&#8206;':
            $v = '&lrm;';
            break;
        case '&#8207;':
            $v = '&rlm;';
            break;
        case '&#8211;':
            $v = '&ndash;';
            break;
        case '&#8212;':
            $v = '&mdash;';
            break;
        case '&#8216;':
            $v = '&lsquo;';
            break;
        case '&#8217;':
            $v = '&rsquo;';
            break;
        case '&#8218;':
            $v = '&sbquo;';
            break;
        case '&#8220;':
            $v = '&ldquo;';
            break;
        case '&#8221;':
            $v = '&rdquo;';
            break;
        case '&#8222;':
            $v = '&bdquo;';
            break;
        case '&#8224;':
            $v = '&dagger;';
            break;
        case '&#8225;':
            $v = '&Dagger;';
            break;
        case '&#8226;':
            $v = '&bull;';
            break;
        case '&#8230;':
            $v = '&hellip;';
            break;
        case '&#8240;':
            $v = '&permil;';
            break;
        case '&#8242;':
            $v = '&prime;';
            break;
        case '&#8243;':
            $v = '&Prime;';
            break;
        case '&#8249;':
            $v = '&lsaquo;';
            break;
        case '&#8250;':
            $v = '&rsaquo;';
            break;
        case '&#8254;':
            $v = '&oline;';
            break;
        case '&#8260;':
            $v = '&frasl;';
            break;
        case '&#8364;':
            $v = '&euro;';
            break;
        case '&#8465;':
            $v = '&image;';
            break;
        case '&#8472;':
            $v = '&weierp;';
            break;
        case '&#8476;':
            $v = '&real;';
            break;
        case '&#8482;':
            $v = '&trade;';
            break;
        case '&#8501;':
            $v = '&alefsym;';
            break;
        case '&#8629;':
            $v = '&crarr;';
            break;
        case '&#8656;':
            $v = '&lArr;';
            break;
        case '&#8657;':
            $v = '&uArr;';
            break;
        case '&#8658;':
            $v = '&rArr;';
            break;
        case '&#8659;':
            $v = '&dArr;';
            break;
        case '&#8660;':
            $v = '&hArr;';
            break;
        case '&#8704;':
            $v = '&forall;';
            break;
        case '&#8706;':
            $v = '&part;';
            break;
        case '&#8707;':
            $v = '&exist;';
            break;
        case '&#8709;':
            $v = '&empty;';
            break;
        case '&#8711;':
            $v = '&nabla;';
            break;
        case '&#8712;':
            $v = '&isin;';
            break;
        case '&#8713;':
            $v = '&notin;';
            break;
        case '&#8715;':
            $v = '&ni;';
            break;
        case '&#8719;':
            $v = '&prod;';
            break;
        case '&#8721;':
            $v = '&sum;';
            break;
        case '&#8722;':
            $v = '&minus;';
            break;
        case '&#8727;':
            $v = '&lowast;';
            break;
        case '&#8730;':
            $v = '&radic;';
            break;
        case '&#8733;':
            $v = '&prop;';
            break;
        case '&#8734;':
            $v = '&infin;';
            break;
        case '&#8736;':
            $v = '&ang;';
            break;
        case '&#8743;':
            $v = '&and;';
            break;
        case '&#8744;':
            $v = '&or;';
            break;
        case '&#8745;':
            $v = '&cap;';
            break;
        case '&#8746;':
            $v = '&cup;';
            break;
        case '&#8747;':
            $v = '&int;';
            break;
        case '&#8756;':
            $v = '&there4;';
            break;
        case '&#8764;':
            $v = '&sim;';
            break;
        case '&#8773;':
            $v = '&cong;';
            break;
        case '&#8776;':
            $v = '&asymp;';
            break;
        case '&#8800;':
            $v = '&ne;';
            break;
        case '&#8801;':
            $v = '&equiv;';
            break;
        case '&#8804;':
            $v = '&le;';
            break;
        case '&#8805;':
            $v = '&ge;';
            break;
        case '&#8834;':
            $v = '&sub;';
            break;
        case '&#8835;':
            $v = '&sup;';
            break;
        case '&#8836;':
            $v = '&nsub;';
            break;
        case '&#8838;':
            $v = '&sube;';
            break;
        case '&#8839;':
            $v = '&supe;';
            break;
        case '&#8853;':
            $v = '&oplus;';
            break;
        case '&#8855;':
            $v = '&otimes;';
            break;
        case '&#8869;':
            $v = '&perp;';
            break;
        case '&#8901;':
            $v = '&sdot;';
            break;
        case '&#8968;':
            $v = '&lceil;';
            break;
        case '&#8969;':
            $v = '&rceil;';
            break;
        case '&#8970;':
            $v = '&lfloor;';
            break;
        case '&#8971;':
            $v = '&rfloor;';
            break;
        case '&#9001;':
            $v = '&lang;';
            break;
        case '&#9002;':
            $v = '&rang;';
            break;
        case '&#8592;':
            $v = '&larr;';
            break;
        case '&#8593;':
            $v = '&uarr;';
            break;
        case '&#8594;':
            $v = '&rarr;';
            break;
        case '&#8595;':
            $v = '&darr;';
            break;
        case '&#8596;':
            $v = '&harr;';
            break;
        case '&#9674;':
            $v = '&loz;';
            break;
        case '&#9824;':
            $v = '&spades;';
            break;
        case '&#9827;':
            $v = '&clubs;';
            break;
        case '&#9829;':
            $v = '&hearts;';
            break;
        case '&#9830;':
            $v = '&diams;';
            break;
        default:
            $v = null;
            break;
    }
    return $v;
}
