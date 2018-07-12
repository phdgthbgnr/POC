@ECHO OFF
set REP=\\servermac\Documents\moana\_img
setlocal enabledelayedexpansion
for /f "delims=" %%i In ('dir /ad/b "%REP%"') DO (
	dir /a-d/b "%REP%\%%i" >nul 2>&1
	if !errorlevel! EQU 0 (
		COPY \\servermac\Documents\moana\_img\us\style.css "%REP%\%%i\"
		COPY \\servermac\Documents\moana\_img\us\style.min.css "%REP%\%%i\"
		) else (
	echo %%i REPERTOIRE VIDE
		)
	)