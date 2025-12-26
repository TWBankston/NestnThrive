# Nest N Thrive — Deployment Guide

This document explains how to deploy the theme and plugin to the production server.

---

## Overview

**What gets deployed:**
- `wp-content/themes/nestnthrive/` → Theme files
- `wp-content/plugins/nnt-core/` → Core plugin

**What NEVER gets deployed:**
- `Project Secrets/` folder
- `wp-content/uploads/` (managed by WordPress)
- Any other plugins (install via WordPress admin)
- Database content

---

## First-Time Setup

### 1. Ensure SSH Key is Configured

Your SSH key should already be set up at:
```
~/.ssh/id_ed25519_nestthrive
```

If not, refer to `Project Secrets/SSH Connection Info.md` for server details.

### 2. Create Local Configuration File

Copy the example config and fill in your credentials:

```powershell
# From project root
Copy-Item "deploy\config.example.ps1" "deploy\config.local.ps1"
```

Then edit `deploy\config.local.ps1` with your actual SSH credentials:
- Refer to `Project Secrets/SSH Connection Info.md` for values
- **Never commit** `config.local.ps1` to git (it's already in `.gitignore`)

### 3. Test SSH Connection

Before deploying, verify you can connect to the server:

```powershell
ssh -i ~/.ssh/id_ed25519_nestthrive -p 65002 u997082716@217.196.55.189
```

If this works, you're ready to deploy.

---

## Deployment Commands

### Deploy Theme Only

```powershell
.\deploy\deploy-theme.ps1
```

Use when you've only changed theme files (templates, styles, functions.php).

### Deploy Plugin Only

```powershell
.\deploy\deploy-plugin.ps1
```

Use when you've only changed plugin files (CPTs, blocks, helpers).

### Deploy Both (Full Deploy)

```powershell
.\deploy\deploy-all.ps1
```

Use after major changes or when unsure what changed.

---

## Deployment Workflow

### Recommended Process

1. **Make changes locally** and test
2. **Commit to git** with descriptive message
3. **Push to GitHub** 
4. **Run deployment script** to push to production
5. **Verify on live site**

### Example Session

```powershell
# After making changes...
git add -A
git commit -m "Add hero section styling for room hub"
git push origin main

# Deploy to production
.\deploy\deploy-theme.ps1
```

---

## Troubleshooting

### "Permission denied (publickey)"

Your SSH key isn't being recognized. Check:
1. Key exists at the path in your config
2. Key has correct permissions (`chmod 600` on Unix)
3. Key is added to Hostinger SSH settings

### "Connection refused" or timeout

1. Verify server IP and port (65002)
2. Check if your IP is whitelisted on Hostinger
3. Try connecting manually with verbose mode:
   ```powershell
   ssh -v -i ~/.ssh/id_ed25519_nestthrive -p 65002 u997082716@217.196.55.189
   ```

### Files not updating on server

1. Clear any server-side cache (Hostinger panel)
2. Clear browser cache / hard refresh
3. Check WordPress cache plugins

---

## Security Notes

### Files That Contain Secrets (NEVER commit)
- `Project Secrets/` — All server credentials
- `deploy/config.local.ps1` — Deployment credentials

### Safe Files (OK to commit)
- `deploy/config.example.ps1` — Template only, no real values
- `deploy/*.ps1` scripts — No embedded secrets
- All theme/plugin code

### .gitignore Protections

The following are automatically excluded from git:
```
Project Secrets/
deploy/config.local.ps1
*.zip
```

---

## Server Paths Reference

| Local Path | Remote Path |
|------------|-------------|
| `wp-content/themes/nestnthrive/` | `/home/[user]/domains/nestnthrive.com/public_html/wp-content/themes/nestnthrive/` |
| `wp-content/plugins/nnt-core/` | `/home/[user]/domains/nestnthrive.com/public_html/wp-content/plugins/nnt-core/` |

---

## Quick Reference

| Task | Command |
|------|---------|
| Deploy theme | `.\deploy\deploy-theme.ps1` |
| Deploy plugin | `.\deploy\deploy-plugin.ps1` |
| Deploy everything | `.\deploy\deploy-all.ps1` |
| Test SSH connection | `ssh -i ~/.ssh/id_ed25519_nestthrive -p 65002 u997082716@217.196.55.189` |

