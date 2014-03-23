<?php
if (!defined('MODX_BASE_PATH')) {
    die('HACK???');
}

require_once 'tv.filter.php';
/**
 * Filters DocLister results by value of a given MODx Template Variables (TVs) with default.
 * @author Agel_Nash <modx@agel-nash.ru>
 *
 */
class tvd_DL_filter extends tv_DL_filter{
	public function get_join(){
        $join = parent::get_join();

        $alias = $this->extTV->TableAlias($this->tvName, "site_tmplvar_contentvalues", $this->getTableAlias());
        $exists = $this->extTV->checkTableAlias($this->tvName, "site_tmplvars");
        $dPrefix = $this->extTV->TableAlias($this->tvName, "site_tmplvars", 'd_'.$this->getTableAlias());
        if(!$exists){
            $join .= " LEFT JOIN ".$this->DocLister->getTable("site_tmplvars", $dPrefix)." on ".$dPrefix.".id = " . $this->tv_id;
            $this->field = "IFNULL(`{$alias}`.`value`, `{$dPrefix}`.`default_text`)";
        }
        return $join;
	}
}