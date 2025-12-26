<#
.SYNOPSIS
    Deploy Nest N Thrive theme to production server

.DESCRIPTION
    Uploads the nestnthrive theme folder to the remote server via SSH/SCP.
    Only syncs the theme files, never touches other wp-content.

.NOTES
    Requires: config.local.ps1 with SSH credentials
    Run from project root: .\deploy\deploy-theme.ps1
#>

# Load configuration
$configPath = Join-Path $PSScriptRoot "config.local.ps1"
if (-not (Test-Path $configPath)) {
    Write-Host "ERROR: config.local.ps1 not found!" -ForegroundColor Red
    Write-Host "Copy config.example.ps1 to config.local.ps1 and fill in your credentials." -ForegroundColor Yellow
    exit 1
}
. $configPath

# Paths
$localThemePath = Join-Path $PSScriptRoot "..\wp-content\themes\nestnthrive"

# Verify local path exists
if (-not (Test-Path $localThemePath)) {
    Write-Host "ERROR: Theme folder not found at $localThemePath" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Nest N Thrive - Theme Deployment" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Local:  $localThemePath" -ForegroundColor Gray
Write-Host "Remote: $SSH_USER@$SSH_HOST:$REMOTE_THEME_PATH" -ForegroundColor Gray
Write-Host ""

# Confirm deployment
$confirm = Read-Host "Deploy theme to production? (y/N)"
if ($confirm -ne "y" -and $confirm -ne "Y") {
    Write-Host "Deployment cancelled." -ForegroundColor Yellow
    exit 0
}

Write-Host ""
Write-Host "Deploying theme..." -ForegroundColor Green

# Use rsync over SSH (preferred) or fall back to scp
# rsync is better as it only transfers changed files
$rsyncAvailable = Get-Command rsync -ErrorAction SilentlyContinue

if ($rsyncAvailable) {
    Write-Host "Using rsync for efficient sync..." -ForegroundColor Gray
    
    # Convert Windows path to WSL/Unix format for rsync
    $unixLocalPath = ($localThemePath -replace "\\", "/") -replace "^([A-Z]):", { "/mnt/" + $_.Groups[1].Value.ToLower() }
    
    rsync -avz --delete `
        -e "ssh -i $SSH_KEY_PATH -p $SSH_PORT" `
        "$unixLocalPath/" `
        "${SSH_USER}@${SSH_HOST}:${REMOTE_THEME_PATH}/"
} else {
    Write-Host "Using scp for file transfer..." -ForegroundColor Gray
    
    # Remove trailing slash and use recursive copy
    scp -i $SSH_KEY_PATH -P $SSH_PORT -r `
        "$localThemePath\*" `
        "${SSH_USER}@${SSH_HOST}:${REMOTE_THEME_PATH}/"
}

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "Theme deployed successfully!" -ForegroundColor Green
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "ERROR: Deployment failed with exit code $LASTEXITCODE" -ForegroundColor Red
    exit $LASTEXITCODE
}

