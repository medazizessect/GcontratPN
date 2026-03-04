#!/bin/bash
# Script pour télécharger TCPDF
cd "$(dirname "$0")"
wget -O tcpdf.zip "https://github.com/tecnickcom/TCPDF/archive/refs/tags/6.7.5.zip"
unzip tcpdf.zip
mv TCPDF-6.7.5/* tcpdf/
rm -rf TCPDF-6.7.5 tcpdf.zip
echo "TCPDF installé avec succès dans web/lib/tcpdf/"
