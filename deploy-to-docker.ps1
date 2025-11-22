# PowerShell script to deploy Automation Studio theme to Docker WordPress

Write-Host "=== Automation Studio - Docker Deployment Script ===" -ForegroundColor Cyan

# Step 1: Build the project
Write-Host "`nStep 1: Building the project..." -ForegroundColor Yellow
npm run build

if ($LASTEXITCODE -ne 0) {
    Write-Host "Build failed! Please fix errors and try again." -ForegroundColor Red
    exit 1
}

# Step 2: Copy built assets to theme folder
Write-Host "`nStep 2: Copying assets to theme folder..." -ForegroundColor Yellow
if (Test-Path "dist\assets") {
    Copy-Item "dist\assets\*" "wordpress-theme\automation-studio\assets\" -Force
    Write-Host "Assets copied successfully!" -ForegroundColor Green
} else {
    Write-Host "dist\assets folder not found! Build may have failed." -ForegroundColor Red
    exit 1
}

# Step 3: List Docker containers
Write-Host "`nStep 3: Looking for WordPress container..." -ForegroundColor Yellow
$containers = docker ps --format "table {{.ID}}\t{{.Names}}\t{{.Image}}"
Write-Host $containers

# Step 4: Ask user for container name
Write-Host "`nPlease enter the name or ID of your WordPress container:" -ForegroundColor Cyan
$containerName = Read-Host

if ([string]::IsNullOrWhiteSpace($containerName)) {
    Write-Host "No container name provided. Exiting." -ForegroundColor Red
    exit 1
}

# Step 5: Copy theme to container
Write-Host "`nStep 5: Copying theme to container $containerName..." -ForegroundColor Yellow
docker cp wordpress-theme\automation-studio "${containerName}:/var/www/html/wp-content/themes/"

if ($LASTEXITCODE -eq 0) {
    Write-Host "`nTheme copied successfully!" -ForegroundColor Green
    
    # Step 6: Fix permissions
    Write-Host "`nStep 6: Fixing permissions..." -ForegroundColor Yellow
    docker exec $containerName chown -R www-data:www-data /var/www/html/wp-content/themes/automation-studio
    
    Write-Host "`n=== Deployment Complete! ===" -ForegroundColor Green
    Write-Host "Go to your WordPress admin panel and activate the 'Automation Studio' theme." -ForegroundColor Cyan
} else {
    Write-Host "`nFailed to copy theme. Please check the container name and try again." -ForegroundColor Red
}
