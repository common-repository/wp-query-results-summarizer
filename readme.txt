=== WP Query Results Summarizer ===
Contributors: phuvidudotcom
Donate link: http://www.phuvidu.com/
Tags: posts, query, archive, search, Query Results Summarizer
Requires at least: 2.6.2
Tested up to: 2.6.3
Stable tag: 08.11.06

An Object Oriented Plugin that summarizes the results returned by a query like a Google search summary text.

== Description ==

An Object Oriented Plugin that summarizes the results returned by a query like a Google search summary text.  

= Feature list: =
*	Easy to use: 
*	Easy to customize by formats: You can format the summary text by the formats and parameters.
*	Easy to modify: the plugin is object oriented and well documented so that you can easily understand and modify the plugin for your customization.
*	No language files need: You can format the output text by the formats in your language so you don't have to write the laguage files.

= What next: =
*   The admin panel is comming soon...

== Installation ==

1.   Upload all files and folders in zip file to the '/wp-content/plugins/' directory
2.   Activate the plugin through the 'Plugins' menu in WordPress
3.   For default usage, put these lines of code in your templates:  
        if (class_exists('PvdWpQueryResultsSummarizer')) {  
            $summarizer = new PvdWpQueryResultsSummarizer();  
            echo $summarizer->getSummary();  
        }  
For advanced usage, please see documentation at http://projects.phuvidu.com/docs/  

== Screenshots ==

1.	An example of summary text returned by a search query
2.	An example of summary text returned by a date query
3.	An example of summary text returned by a category query
4.	An example of summary text returned by a tag query
5.	An example of summary text returned by a author query

