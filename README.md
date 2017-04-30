# DATS2410_WebApp
This i a web application for the third obligatory assignment through the class Network and Cloud Computing. The application is coded in PHP, and talks to a database-server which runs MariaDB. In our network there is a total of 8 servers. We have one load balancer that distributes the traffic through to all of the three web servers equally. All the web servers are connected to a three more databases through a proxyserver. With this type of setup if one of the web servers or one of the database servers is down, we can still connect to the site and use the sites services. 

Our application comes with some predefined students, courses and study programs. These can be altered all you want, and you can also add new ones, or delete the ones you no longer want.

The URL to our site: http://dats.vlab.cs.hioa.no:8004/