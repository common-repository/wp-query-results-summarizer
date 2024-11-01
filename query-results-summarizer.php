<?php 
	/*
Plugin Name: WP Query Results Summarizer
Plugin URI: http://blog.phuvidu.com/wordpress/plugins/wordpress-query-results-summarizer
Description: An Object Oriented Plugin that summarizes the results returned by a query. The summary text can be customized by optional formats. The default format is similar to a Google search summary text.
Version: 08.11.06
Author: phuvidudotcom
Author URI: http://www.phuvidu.com/
*/

/*  Copyright 2008  phuvidudotcom  (email : me@phuvidu.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License (see <http://www.gnu.org/licenses/>)
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * PvdWpQueryResultsSummarizer.php
 * 
 * This file contains the core class of Wordpress Query Results Summarizer - PvdWpQueryResultsSummarizer.
 * 
 * @package		PvdWp
 * @subpackage	plugins
 * @author		phuvidudotcom <me@phuvidu.com>
 * @copyright	2008 phuvidudotcom
 * @license		http://www.gnu.org/licenses/gpl.txt GNU GPL version 3
 * @version		08.11.06
 * @since		08.11.06
 */
 
/**
 * A wordpress query results summarizer
 *
 * This class summarizes the results returned by a query. Supported query types:
 * <ul>
 * <li>Search query: The posts are queried by a search, when user searches for a search string.</li>
 * <li>Date query: The posts is queried in a day, a month or a year, when user gets an archive by date.</li>
 * <li>Category query: The posts are queried by a category, when user gets all posts by a specified category.</li>
 * <li>Tag query: The posts are queried by a tag, when user gets all posts by a specified tag.</li>
 * <li>Author query: The posts are queried by an author, when user gets all posts by a specified author.</li>
 * </ul>
 * The summary text can be customized by optional formats. The default format is similar to a Google search summary text.
 */
class PvdWpQueryResultsSummarizer
{
	/**
	 * An attribute indicating whether summarize results returned by a search query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeSearchResults;

	/**
	 * An attribute indicating whether summarize results returned by a date query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeDateResults;

	/**
	 * An attribute indicating whether summarize results returned by a category query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeCatResults;

	/**
	 * An attribute indicating whether summarize results returned by a tag query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeTagResults;

	/**
	 * An attribute indicating whether summarize results returned by a author query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeAuthResults;

	/**
	 * An attribute indicating whether summarize empty result returned by a query or not
	 *
	 * @var boolean
	 * @access private
	 */
	private $m_bSummarizeEmptyResult;

	/**
	 * The prefix of the summary text
	 *
	 * @var string
	 * @access private
	 */
	private $m_strPrefix;

	/**
	 * The suffix of the summary text
	 *
	 * @var string
	 * @access private
	 */
	private $m_strSuffix;

	/**
	 * The day format
	 *
	 * This format is used for a day query.
	 *
	 * @var string
	 * @access private
	 */
	private $m_strDayFormat;

	/**
	 * The month format
	 *
	 * This format is used for a month query.
	 *
	 * @var string
	 * @access private
	 */
	private $m_strMonthFormat;

	/**
	 * The year format
	 *
	 * This format is used for a year query.
	 *
	 * @var string
	 * @access private
	 */
	private $m_strYearFormat;

	/**
	 * The format of the summary text returned by a search query
	 *
	 * @var string
	 * @access private
	 */
	private $m_strSearchSummaryFormat;

	/**
	 * The format of the summary text returned by a date query
	 *
	 * @var string
	 * @access private
	 */
	private $m_strDateSummaryFormat;

	/**
	 * The format of the summary text returned by a category query
	 *
	 * @var string
	 * @access private
	 */
	private $m_strCatSummaryFormat;

	/**
	 * The format of the summary text returned by a tag query
	 *
	 * @var string
	 * @access private
	 */
	private $m_strTagSummaryFormat;

	/**
	* The format of the summary text returned by an author query
	*
	* @var string
	* @access private
	*/
	private $m_strAuthSummaryFormat;

	/**
	* The summary text when there is no post returned by a search query
	*
	* @var string
	* @access private
	*/
	private $m_strEmptySummary;

    /**
     * Constructor for the PvdWpQueryResultsSummarizer class
     * 
	 * PHP version 5
	 *
     * @access public
     * @return void
     */
    public function __construct()
    {
		$this->setDefaultSettings();
    }
	
	 /**
     * Constructor for the PvdWpQueryResultsSummarizer class
     * 
	 * PHP version 4
	 *
     * @access public
     * @return void
     */
    public function PvdWpQueryResultsSummarizer()
    {
		$this->setDefaultSettings();
    }

     /**
     * Checks whether summarize results returned by a search query or not
     * 
     * @access public
     * @return boolean The value indicating whether summarize results returned by a search query or not
     */
    public function isSummarizeSearchResults()
    {
		return $this->m_bSummarizeSearchResults;
    }

	/**
     * Sets whether summarize results returned by a search query or not 
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether summarize results returned by a search query or not 
     * @access public
     * @return void
     */
    public function setSummarizeSearchResults($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeSearchResults = $value;
		}
    }

	 /**
     * Checks whether summarize results returned by a date query or not 
     * 
     * @access public
     * @return boolean The value indicating whether summarize results returned by a date query or not 
     */
    public function isSummarizeDateResults()
    {
		return $this->m_bSummarizeDateResults;
    }

	/**
     * Sets whether summarize results returned by a date query or not
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether summarize results returned by a date query or not
     * @access public
     * @return void
     */
    public function setSummarizeDateResults($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeDateResults = $value;
		}
    }
	
	/**
     * Checks whether summarize results returned by a category query or not
     * 
     * @access public
     * @return boolean The value indicating whether whether summarize results returned by a category query or not
     */
    public function isSummarizeCatResults()
    {
		return $this->m_bSummarizeCatResults;
    }

	/**
     * Sets whether the category query summary is summarized or not 
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether the category query summary is summarized or not
     * @access public
     * @return void
     */
    public function setSummarizeCatResults($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeCatResults = $value;
		}
    }
	
	/**
     * Checks whether summarize results returned by a tag query or not
     * 
     * @access public
     * @return boolean The value indicating whether summarize results returned by a tag query or not
     */
    public function isSummarizeTagResults()
    {
		return $this->m_bSummarizeTagResults;
    }

	/**
     * Sets whether summarize results returned by a tag query or not
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether summarize results returned by a tag query or not
     * @access public
     * @return void
     */
    public function setSummarizeTagResults($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeTagResults = $value;
		}
    }

	/**
     * Checks whether summarize results returned by a author query or not
     * 
     * @access public
     * @return boolean The value indicating whether summarize results returned by a author query or not
     */
    public function isSummarizeAuthResults()
    {
		return $this->m_bSummarizeAuthResults;
    }

	/**
     * Sets whether summarize results returned by a author query or not
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether summarize results returned by a author query or not
     * @access public
     * @return void
     */
    public function setSummarizeAuthResults($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeAuthResults = $value;
		}
    }
	
	/**
     * Checks whether summarize empty result returned by a query or not
     * 
     * @access public
     * @return boolean The value indicating whether summarize empty result returned by a query or not
     */
    public function isSummarizeEmptyResult()
    {
		return $this->m_bSummarizeEmptyResult;
    }

	/**
     * Sets whether summarize empty result returned by a query or not
     * 
	 * If the input value is not a valid boolean value then it is ignored.
	 *
     * @param mixed $value The value indicating whether summarize empty result returned by a query or not
     * @access public
     * @return void
     */
    public function setSummarizeEmptyResult($value)
    {
		if (is_bool($value)) {
			$this->m_bSummarizeEmptyResult = $value;
		}
    }
	
	/**
     * Gets the prefix of the summary text
     * 
     * @access public
     * @return string The prefix of the summary text.
     */
	public function getPrefix()
    {
		return $this->m_strPrefix;
    }

	/**
     * Sets the prefix of the summary text
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The prefix of the summary text.
     * @access public
     * @return void
     */
    public function setPrefix($value)
    {
		$this->m_strPrefix = strval($value);
    }
	
	/**
     * Gets the suffix of the summary text
     * 
     * @access public
     * @return string The suffix of the summary text.
     */
	public function getSuffix()
    {
		return $this->m_strSuffix;
    }

	/**
     * Sets the suffix of the summary text
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The suffix of the summary text.
     * @access public
     * @return void
     */
    public function setSuffix($value)
    {
		$this->m_strSuffix = strval($value);
    }
	
	/**
     * Gets the day format
     * 
     * @access public
     * @return string The day format.
     */
	public function getDayFormat()
    {
		return $this->m_strDayFormat;
    }

	/**
     * Sets the day format
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The day format.
     * @access public
     * @return void
     */
    public function setDayFormat($value)
    {
		$this->m_strDayFormat = strval($value);
    }	
	
	/**
     * Gets the month format
     * 
     * @access public
     * @return string The month format.
     */
	public function getMonthFormat()
    {
		return $this->m_strMonthFormat;
    }

	/**
     * Sets the month format
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The month format.
     * @access public
     * @return void
     */
    public function setMonthFormat($value)
    {
		$this->m_strMonthFormat = strval($value);
    }	

		/**
     * Gets the year format
     * 
     * @access public
     * @return string The year format.
     */
	public function getYearFormat()
    {
		return $this->m_strYearFormat;
    }

	/**
     * Sets the year format
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The year format.
     * @access public
     * @return void
     */
    public function setYearFormat($value)
    {
		$this->m_strYearFormat = strval($value);
    }

	/**
     * Gets the format of the summary text returned by a search query
     * 
     * @access public
     * @return string The format of the summary text returned by a search query
     */
	public function getSearchSummaryFormat()
    {
		return $this->m_strSearchSummaryFormat;
    }

	/**
     * Sets the format of the summary text returned by a search query
     * 
	 * The input value must be converted to a string value. Following are acceptable parameters can be used to format the text:
	 * <ul>
	 * <li>%firstPostIndex% The index of the first post being displayed.</li>
	 * <li>%lastPostIndex% The index of the last post being displayed.</li>
	 * <li>%totalPosts% The total number of the posts returned by the query.</li>
	 * <li>%searchString% The search string used for the query.</li>
	 * </ul>
	 *
     * @param mixed $value The format of the summary text returned by a search query
     * @access public
     * @return void
     */
    public function setSearchSummaryFormat($value)
    {
		$this->m_strSearchSummaryFormat = strval($value);
    }

	/**
     * Gets the format of the summary text returned by a date query
     * 
     * @access public
     * @return string The format of the summary text returned by a date query
     */
	public function getDateSummaryFormat()
    {
		return $this->m_strDateSummaryFormat;
    }

	/**
     * Sets the format of the summary text returned by a date query
     * 
	 * The input value must be converted to a string value. Following are acceptable parameters can be used to format the text:
	 * <ul>
	 * <li>%firstPostIndex% The index of the first post being displayed.</li>
	 * <li>%lastPostIndex% The index of the last post being displayed.</li>
	 * <li>%totalPosts% The total number of the posts returned by the query.</li>
	 * <li>%date% The date used for the query.</li>
	 * </ul>
	 *
     * @param mixed $value The format of the summary text returned by a date query
     * @access public
     * @return void
     */
    public function setDateSummaryFormat($value)
    {
		$this->m_strDateSummaryFormat = strval($value);
    }

	/**
     * Gets the format of the summary text returned by a category query
     * 
     * @access public
     * @return string The format of the summary text returned by a category query
     */
	public function getCatSummaryFormat()
    {
		return $this->m_strCatSummaryFormat;
    }

	/**
     * Sets the format of the summary text returned by a category query
     * 
	 * The input value must be converted to a string value. Following are acceptable parameters can be used to format the text:
	 * <ul>
	 * <li>%firstPostIndex% The index of the first post being displayed.</li>
	 * <li>%lastPostIndex% The index of the last post being displayed.</li>
	 * <li>%totalPosts% The total number of the posts returned by the query.</li>
	 * <li>%cat% The category used for the query.</li>
	 * </ul>
	 *
     * @param mixed $value The format of the summary text returned by a category query
     * @access public
     * @return void
     */
    public function setCatSummaryFormat($value)
    {
		$this->m_strCatSummaryFormat = strval($value);
    }

	/**
     * Gets the format of the summary text returned by a tag query
     * 
     * @access public
     * @return string The format of the summary text returned by a tag query
     */
	public function getTagSummaryFormat()
    {
		return $this->m_strTagSummaryFormat;
    }

	/**
     * Sets the format of the summary text returned by a tag query
     * 
	 * The input value must be converted to a string value. Following are acceptable parameters can be used to format the text:
	 * <ul>
	 * <li>%firstPostIndex% The index of the first post being displayed.</li>
	 * <li>%lastPostIndex% The index of the last post being displayed.</li>
	 * <li>%totalPosts% The total number of the posts returned by the query.</li>
	 * <li>%tag% The tag used for the query.</li>
	 * </ul>
	 *
     * @param mixed $value The format of the summary text returned by a tag query
     * @access public
     * @return void
     */
    public function setTagSummaryFormat($value)
    {
		$this->m_strTagSummaryFormat = strval($value);
    }	

	/**
     * Gets the format of the summary text returned by a author query
     * 
     * @access public
     * @return string The format of the summary text returned by a author query
     */
	public function getAuthSummaryFormat()
    {
		return $this->m_strAuthSummaryFormat;
    }

	/**
     * Sets the format of the summary text returned by a author query
     * 
	 * The input value must be converted to a string value. Following are acceptable parameters can be used to format the text:
	 * <ul>
	 * <li>%firstPostIndex% The index of the first post being displayed.</li>
	 * <li>%lastPostIndex% The index of the last post being displayed.</li>
	 * <li>%totalPosts% The total number of the posts returned by the query.</li>
	 * <li>%auth% The author used for the query.</li>
	 * </ul>
	 *
     * @param mixed $value The format of the summary text returned by a author query
     * @access public
     * @return void
     */
    public function setAuthSummaryFormat($value)
    {
		$this->m_strAuthSummaryFormat = strval($value);
    }	

	/**
     * Gets the summary text when there is no post returned by a search query
     * 
     * @access public
     * @return string The summary text when there is no post returned by a search query
     */
	public function getEmptySummary()
    {
		return $this->m_strEmptySummary;
    }

	/**
     * Sets the summary text when there is no post returned by a search query
     * 
	 * The input value must be converted to a string value.
	 *
     * @param mixed $value The summary text when there is no post returned by a search query
     * @access public
     * @return void
     */
    public function setEmptySummary($value)
    {
		$this->m_strEmptySummary = strval($value);
    }	
	
	/**
     * Sets default settings
     * 
	 * Following are default values:
	 * <ul>
	 * <li>Summarize search results: <code>true</code></li>
	 * <li>Summarize date results: <code>true</code></li>
	 * <li>Summarize category results: <code>true</code></li>
	 * <li>Summarize tag results: <code>true</code></li>
	 * <li>Summarize author results: <code>true</code></li>
	 * <li>Summarize empty results: <code>false</code></li>
	 * <li>Prefix: <code><p></code></li>
	 * <li>Prefix: <code></p></code></li>
	 * <li>Year format: <code>Y</code></li>
	 * <li>Month format: <code>F, Y</code></li>
	 * <li>Day format: <code>l, F jS, Y</code></li>
	 * <li>Search summary format: <code>Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%searchString%</b>.</code></li>
	 * <li>Date summary format: <code>Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%date%</b>.</code></li>
	 * <li>Category summary format: <code>Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%cat%</b>.</code></li>
	 * <li>Tag summary format: <code>Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%tag%</b>.</code></li>
	 * <li>Author summary format: <code>Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%auth%</b>.</code></li>
	 * <li>Empty summary: <code>There is no relevant post.</code></li>
	 * </ul>
     * @access public
     * @return void
     */
	public function setDefaultSettings()
	{
		$this->setSummarizeSearchResults(true);
		$this->setSummarizeDateResults(true);
		$this->setSummarizeCatResults(true);
		$this->setSummarizeTagResults(true);
		$this->setSummarizeAuthResults(true);
		$this->setSummarizeEmptyResult(false);
		
		$this->setPrefix('<p>');
		$this->setSuffix('</p>');
		
		$this->setYearFormat('Y');
		$this->setMonthFormat('F, Y');
		$this->setDayFormat('l, F jS, Y');
		
		$this->setSearchSummaryFormat('Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> for <b>%searchString%</b>.');
		$this->setDateSummaryFormat('Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> in <b>%date%</b>.');
		$this->setCatSummaryFormat('Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> by <b>the category: %cat%</b>.');
		$this->setTagSummaryFormat('Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> by <b>the tag: %tag%</b>.');
		$this->setAuthSummaryFormat('Results <b>%firstPostIndex% - %lastPostIndex%</b> of about <b>%totalPosts%</b> by <b>the author: %auth%</b>.');
		$this->setEmptySummary('There is no relevant post.');
	}
	/**
	* Get the summary text returned by a query
	*
	* @access public
	* @return string
	*/
	public function getSummary()
	{
		if ((is_search() && $this->isSummarizeSearchResults()) || 
			(is_date() && $this->isSummarizeDateResults()) || 
			(is_category() && $this->isSummarizeCatResults()) || 
			(is_tag() && $this->isSummarizeTagResults()) || 
			(is_author() && $this->isSummarizeAuthResults())) {
			/* Global wordpress's options */
			global $posts_per_page, $paged, $wp_query, $author_name, $author;
			
			$total_posts = $wp_query->found_posts;
			if ($total_posts > 0) {
				if (empty($paged)) {
					$paged = 1;
				}
				$first_post_index = ($posts_per_page * $paged) - $posts_per_page + 1;
				if (($first_post_index + $posts_per_page - 1) >= $total_posts) {
					$last_post_index = $total_posts;
				} 
				else {
					$last_post_index = $first_post_index + $posts_per_page - 1;
				}
				/* Format summary text */
				$params = array();
				$values = array();
				$params['firstPostIndex'] = '%firstPostIndex%';
				$values['firstPostIndex'] = number_format($first_post_index);
				$params['lastPostIndex'] = '%lastPostIndex%';
				$values['lastPostIndex'] = number_format($last_post_index);
				$params['totalPosts'] = '%totalPosts%';
				$values['totalPosts'] = number_format($total_posts);
				if (is_search()) {
					$summary_text = $this->getSearchSummaryFormat();
					$params['searchString'] = '%searchString%';
					$values['searchString'] = get_search_query();
				}
				elseif (is_date()) {
					$summary_text = $this->getDateSummaryFormat();
					$params['date'] = '%date%';
					if (is_year()) {
						$values['date'] = get_the_time($this->getYearFormat());
					}
					elseif (is_month()) {
						$values['date'] = get_the_time($this->getMonthFormat());
					}
					else { /* is day */
						$values['date'] = get_the_time($this->getDayFormat());
					}
				}
				elseif (is_category()) {
					$summary_text = $this->getCatSummaryFormat();
					$params['cat'] = '%cat%';
					$values['cat'] = single_cat_title('', false);
				}
				elseif (is_tag()) {
					$summary_text = $this->getTagSummaryFormat();
					$params['tag'] = '%tag%';
					$values['tag'] = single_tag_title('', false);
				}
				elseif (is_author()) {
					$summary_text = $this->getAuthSummaryFormat();
					if (isset($_GET['author_name'])) {
						$curauth = get_userdatabylogin($author_name);
					}
					else {
						$curauth = get_userdata(intval($author));
					}
					$params['auth'] = '%auth%';
					$values['auth'] = $curauth->nickname;
				}
				$summary_text = str_replace($params, $values, $summary_text);
				unset($params);
				unset($values);
			}
			else {
				if ($this->isSummarizeEmptyResult()) {
					$summary_text = $this->getEmptySummary();
				}
			}
		}
		if (empty($summary_text) == false) {
			$summary_text = $this->getPrefix() . $summary_text . $this->getSuffix();
		}
		return $summary_text;
	}
}
?>