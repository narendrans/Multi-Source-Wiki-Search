solr-wikipedia-conf
===================

Configuration files for Solr wikipedia. Part of the tweet categorization project. 


TO USE
-------------

Download a copy of [Solr](http://lucene.apache.org/). These config files tested only with Solr 4.3.0, but try newest version. 

Add these config files to (solr-dir)/example/solr/collection1/conf. 

- *schema.xml* specifies the layout of the Solr index. Shouldn't change much. 
- *wiki-import-config.xml* specifies how Solr should read the Wikipedia XML file. Based on the Solr wiki Wikipedia example. 
- *solrconfig.xml* is configuration and setup of the main query service I use, query_clustering. Probably the most likely thing that'll need changing. 

Get enwiki-latest-pages-articles.xml from the [Wikipedia download page](http://dumps.wikimedia.org/enwiki/latest/).
Add it to (solr-dir)/example

Run java -jar start.jar in (solr-dir)/example, go to localhost:8983/solr, and start the import!

Note: this import requires a few hours and gigabytes of disk space and memory. If in doubt, test with a smaller piece of Wikipedia. 
