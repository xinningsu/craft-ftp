<p align="center"><img src="./src/icon.svg" width="100" height="100" alt="FTP integration for Craft CMS"></p>

<h1 align="center">FTP integration for Craft CMS</h1>

This plugin provides a FTP integration for [Craft CMS](https://craftcms.com/), with this plugin we can create a FTP volume type for Craft CMS.

## Requirements

 - PHP 8.0.2 or later
 - Craft CMS 4.0 or later

## Installation

We can install this plugin with Composer.
Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require xinningsu/craft-ftp

# tell Craft to install the plugin
./craft plugin/install craft-ftp
```

## Setup

To create a new FTP filesystem to use with your volumes, 

- Login admin, visit **Settings** → **Filesystems**,
- Press **New filesystem**. 
- Select “FTP” for the **Filesystem Type** 
- Setting and configure as needed.
