<#
.SYNOPSIS
    Deploy both theme and plugin to production server

.DESCRIPTION
    Deploys both the nestnthrive theme and nnt-core plugin in one operation.
    Prompts for confirmation before each deployment.

.NOTES
    Requires: config.local.ps1 with SSH credentials
    Run from project root: .\deploy\deploy-all.ps1
#>

Write-Host ""
Write-Host "========================================" -ForegroundColor Magenta
Write-Host "  Nest N Thrive - Full Deployment" -ForegroundColor Magenta
Write-Host "========================================" -ForegroundColor Magenta
Write-Host ""
Write-Host "This will deploy BOTH theme and plugin to production." -ForegroundColor Yellow
Write-Host ""

$confirm = Read-Host "Continue with full deployment? (y/N)"
if ($confirm -ne "y" -and $confirm -ne "Y") {
    Write-Host "Deployment cancelled." -ForegroundColor Yellow
    exit 0
}

# Deploy plugin first (theme may depend on it)
Write-Host ""
Write-Host "--- Deploying Plugin ---" -ForegroundColor Cyan
& "$PSScriptRoot\deploy-plugin.ps1"

if ($LASTEXITCODE -ne 0) {
    Write-Host "Plugin deployment failed. Stopping." -ForegroundColor Red
    exit $LASTEXITCODE
}

# Deploy theme
Write-Host ""
Write-Host "--- Deploying Theme ---" -ForegroundColor Cyan
& "$PSScriptRoot\deploy-theme.ps1"

if ($LASTEXITCODE -ne 0) {
    Write-Host "Theme deployment failed." -ForegroundColor Red
    exit $LASTEXITCODE
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "  Full deployment completed!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""

