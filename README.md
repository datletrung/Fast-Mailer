# Fast Mailer

Create a temporary email server  

## Getting Started

A just-for-fun project!  

### Prerequisites

Raspberry Pi 3B (or a VPS)  
Postfix, Apache2, PHP  

### Installing
 
Setup and config Postfix Mail Server using this following tutorial:  

```
https://www.tecmint.com/install-postfix-mail-server-with-webmail-in-debian/
```

Note: You DO NOT have to setup Dovecot and Rainloop. However, in order for the server to function correctly, I highly recommend you to setup relay host via Google SMTP.  

Download or clone the repository and extract in to website directory (/var/www/html).   

A user on this Linux system will be an email. For example, Raspberry Pi has default user is "pi", there will be an email pi@yourdomain.com.  
New email will come into /home/{yourusername}/mailbox/new/ (if you configured your Postfix follow the tutorial above).  
File /mailer/fetch.php will pull out email from this folder. Therefore, if your configuration are different from mine, you should change this in /mailer/fetch.php  


## Authors  

* **Brian Le** - **Lê Trung Tất Đạt** - (https://github.com/datletrung)  
