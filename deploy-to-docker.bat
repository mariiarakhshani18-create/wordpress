@echo off
echo === Automation Studio - Docker Deployment Script ===
echo.

echo Step 1: Building the project...
call npm run build
if %ERRORLEVEL% NEQ 0 (
    echo Build failed! Please fix errors and try again.
    pause
    exit /b 1
)

echo.
echo Step 2: Copying assets to theme folder...
if exist "dist\assets" (
    if not exist "wordpress-theme\automation-studio\assets\" mkdir "wordpress-theme\automation-studio\assets\"
    xcopy "dist\assets\*" "wordpress-theme\automation-studio\assets\" /Y /I
    echo Assets copied successfully!
) else (
    echo dist\assets folder not found! Build may have failed.
    pause
    exit /b 1
)

echo.
echo Step 3: Looking for WordPress containers...
docker ps

echo.
echo Please enter the name or ID of your WordPress container:
set /p CONTAINER_NAME=

if "%CONTAINER_NAME%"=="" (
    echo No container name provided. Exiting.
    pause
    exit /b 1
)

echo.
echo Step 5: Copying theme to container %CONTAINER_NAME%...
docker cp wordpress-theme\automation-studio %CONTAINER_NAME%:/var/www/html/wp-content/themes/

if %ERRORLEVEL% EQU 0 (
    echo.
    echo Theme copied successfully!
    
    echo.
    echo Step 6: Fixing permissions...
    docker exec %CONTAINER_NAME% chown -R www-data:www-data /var/www/html/wp-content/themes/automation-studio
    
    echo.
    echo === Deployment Complete! ===
    echo Go to your WordPress admin panel and activate the 'Automation Studio' theme.
) else (
    echo.
    echo Failed to copy theme. Please check the container name and try again.
)

echo.
pause
