# Nest N Thrive - Deployment Configuration Template
# ================================================
# Copy this file to config.local.ps1 and fill in your actual values
# NEVER commit config.local.ps1 to git!

# SSH Connection
$SSH_HOST = "your-server-ip"
$SSH_PORT = "65002"
$SSH_USER = "your-username"
$SSH_KEY_PATH = "$HOME\.ssh\your-private-key"

# Remote Paths (Hostinger typical structure)
$REMOTE_BASE = "/home/your-username/domains/nestnthrive.com/public_html"
$REMOTE_THEME_PATH = "$REMOTE_BASE/wp-content/themes/nestnthrive"
$REMOTE_PLUGIN_PATH = "$REMOTE_BASE/wp-content/plugins/nnt-core"

