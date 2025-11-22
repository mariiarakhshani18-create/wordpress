# Docker Deployment Guide

This guide explains how to deploy the `automation-studio` theme to your WordPress Docker container.

## Prerequisites
- You have a running WordPress Docker container.
- You know the container ID or name (run `docker ps` to find it).

## Method 1: Using `docker cp` (Easiest)

1.  **Identify your container name**:
    ```bash
    docker ps
    ```
    Look for the container running the `wordpress` image. Let's assume it's named `my-wordpress`.

2.  **Copy the theme folder**:
    Run this command from the project root (where `wordpress-theme` folder is located):
    ```bash
    docker cp wordpress-theme/automation-studio my-wordpress:/var/www/html/wp-content/themes/
    ```

3.  **Activate the theme**:
    - Go to your WordPress Admin Dashboard (usually `http://localhost:8000/wp-admin` or similar).
    - Navigate to **Appearance > Themes**.
    - You should see **Automation Studio**. Click **Activate**.

## Method 2: Using Volumes (If you have a mounted theme folder)

If your Docker setup maps a local directory to `/var/www/html/wp-content/themes`, simply copy the `wordpress-theme/automation-studio` folder into that local directory.

## Troubleshooting

- **Permissions**: If you can't see the theme or get permission errors, you might need to fix ownership inside the container:
    ```bash
    docker exec -it my-wordpress chown -R www-data:www-data /var/www/html/wp-content/themes/automation-studio
    ```
- **Missing Styles/Scripts**: Ensure you ran `npm run build` and the `assets` folder exists inside `automation-studio`.
