**********************************************************************
																	 
Instructions for setting up Multi-Source wiki search engine.		 
																	 
**********************************************************************

Hardware requirements:

You can use any decent hardware that can run java without any issues. A higher RAM is recommended if you are going to re-index.

Software requirements:

The application was developed in Mac OS X Mavericks. We recommend using the same version of OS even though any unix based operating system will be sufficient.

Steps to set up solr:

1. Download the latest version of solr from `http://lucene.apache.org/solr/downloads.html`
2. There are three cores, each one is used to hold the index for a wiki. 
   Collection1 - Wikipedia
   Collection2 - Wikiquote
   Collection3 - Wikinews
3. Copy the three folders collection1,collection2,collection3 provided to the below folder,
   `solr-<version>/example`
4. Start the solr using the below command
   `java -Xmx1024m -jar <path to solr>/example/start.jar`
5. Solr should now be running in localhost:8983 by default.

Steps to set up XAMPP:
	
We use XAMPP for php and mysql.
	
1. Download XAMPP from `http://www.apachefriends.org/en/xampp.html`
2. Located the htdocs folder and copy the files in IR directory to the htdocs directory.
3. Use phpmyadmin to import the sql db of quotes. You can configure the db connection parameters in the getQuotes.php
4. While you may use the same API key, we strongly recommend to apply for a new API key from big huge labs for query expansion module.
5. Create a twitter app from twitter developers page and use the authentication codes to use the twitter integration module.
6. Run the Apache and MySql server.
7. You can now run the application by visiting the below URL
	`http://localhost/ir`

