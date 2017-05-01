# DATS2410_WebApp
This i a web application for the third obligatory assignment through the class Network and Cloud Computing. The application is coded in PHP, and talks to a database-server which runs MariaDB.
In our network there is a total of 8 servers. We have one load balancer that distributes the traffic through to all of the three web servers equally. All the web servers are connected to a three more databases through a proxyserver.
With this type of setup if atleast one of the web servers or one of the database is up, even if 2 web servers or database servers are down. We can still connect to the site and use the sites services. 

Our application comes with some predefined students, courses and study programs. These can all be altered, and you can also add new ones, or delete the ones you no longer want/need.

The URL to our site: http://dats.vlab.cs.hioa.no:8004/
