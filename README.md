# Fastmailer

Create a temporary email  

## Getting Started

A just-for-fun project!  

### Prerequisites

Postfix, Apache2  
PHP, Javascript  
Raspberry Pi 3B (or a VPS)

### Installing
 
Setup and config Postfix Mail Server following this tutorial:  

```
https://www.tecmint.com/install-postfix-mail-server-with-webmail-in-debian/
```

Note: You DO NOT have to setup Dovecot and Rainloop. However, in order to function correctly, I highly recommend you to setup relay host via Google SMTP.  

Download the repository and extract in to website directory (/var/www/html):  

```
git clone https://github.com/datletrung/onetimemail.git
```

A user on this Linux system will be an email. For example, Raspberry Pi has default user is "pi", there will be an email pi@yourdomain.com.  
New email will come into /home/{yourusername}/mailbox/new/ (if you configured your Postfix follow the tutorial above).  
File /mailer/fetch.php will pull out email from this folder. Therefore, if your configuration are different from me, you should change this in /mailer/fetch.php  

### Running the code

Watch video here:  

```
https://youtu.be/a7jvCzCBHZc
```

## Authors  

* **Tin Le** - **Lê Trung Tất Đạt** - (https://github.com/datletrung)  
