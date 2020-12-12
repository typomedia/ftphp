# Ftphp

This tool uploads and downloads single files from a ftp server.

## Download

[ftphp.phar](https://github.com/typomedia/ftphp/raw/master/dist/ftphp.phar)

## Usage
    php ftphp.phar get [options] [--] <remotefile> <localfile>
    php ftphp.phar put [options] [--] <localfile> <remotefile>

### Argument

    remotefile                 File on FTP server
    localfile                  File in local filesystem

### Options
   
    -a, --address[=ADDRESS]    Server address
    -u, --username[=USERNAME]  Username
    -p, --password[=PASSWORD]  Password

## Help

    php ftphp.phar get --help
    php ftphp.phar put --help

## Downloading
    
    # command for downloading 'example.zip'
    php ftphp.phar get -address ftp.example.com -username ftpuser -password ******** example.zip

    # shortcut command for downloading 'example.zip'
    php ftphp.phar get -a ftp.example.com -u ftpuser -p ******** example.zip
    
    # shortcut command for downloading 'example.zip' to '/tmp/demo.zip'
    php ftphp.phar get -a ftp.example.com -u ftpuser -p ******** example.zip /tmp/demo.zip
    
## Uploading
    
    # command for uploading 'example.zip'
    php ftphp.phar put -address ftp.example.com -username ftpuser -password ******** ~/example.zip

    # shortcut command for uploading 'example.zip'
    php ftphp.phar put -a ftp.example.com -u ftpuser -p ******** ~/example.zip
    
    # shortcut command for uploading '~/example.zip' to 'demo.zip'
    php ftphp.phar put -a ftp.example.com -u ftpuser -p ******** ~/example.zip demo.zip

---
© 2020 Typomedia Foundation. Created with ♥ in Heidelberg by Philipp Speck.