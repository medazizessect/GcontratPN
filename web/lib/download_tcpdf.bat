@echo off
echo Téléchargement de TCPDF...
powershell -Command "Invoke-WebRequest -Uri 'https://github.com/tecnickcom/TCPDF/archive/refs/tags/6.7.5.zip' -OutFile 'tcpdf.zip'"
powershell -Command "Expand-Archive -Path 'tcpdf.zip' -DestinationPath '.'"
xcopy /E /I TCPDF-6.7.5\* tcpdf\
rmdir /S /Q TCPDF-6.7.5
del tcpdf.zip
echo TCPDF installé avec succès!
pause
