<?php

/* Copyright (c) 1998-2009 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 *
 *
 * @author Fabian Wolf <wolf@leifos.de>
 * @version $Id: $
 * @ingroup Services/LDAP
 */
class ilLDAPRoleGroupMappingSetting
{
    /**
     * constructor
     * @global ilDB $ilDB
     * @param int $a_mapping_id
     */
    public function __construct($a_mapping_id)
    {
        global $DIC;

        $ilDB = $DIC['ilDB'];
        $this->db = $ilDB;
        $this->mapping_id = $a_mapping_id;
    }
    
    /**
     * read data from db
     */
    public function read()
    {
        $query = "SELECT * FROM ldap_rg_mapping "
                . "WHERE mapping_id = " . $this->db->quote($this->getMappingId(), 'integer');
        $set = $this->db->query($query);
        $rec = $this->db->fetchAssoc($set);
        
        $this->setMappingId($rec["mapping_id"]);
        $this->setServerId($rec["server_id"]);
        $this->setURL($rec["url"]);
        $this->setDN($rec["dn"]);
        $this->setMemberAttribute($rec["member_attribute"]);
        $this->setMemberISDN($rec["member_isdn"]);
        $this->setRole($rec["role"]);
        $this->setMappingInfo($rec["mapping_info"]);
        $this->setMappingInfoType($rec["mapping_info_type"]);
    }
    
    /**
     * delete mapping by id
     */
    public function delete()
    {
        $query = "DELETE FROM ldap_rg_mapping " .
            "WHERE mapping_id = " . $this->db->quote($this->getMappingId(), 'integer');
        $res = $this->db->manipulate($query);
    }
    
    /**
     * update mapping by id
     */
    public function update()
    {
        $query = "UPDATE ldap_rg_mapping " .
                    "SET server_id = " . $this->db->quote($this->getServerId(), 'integer') . ", " .
                    "url = " . $this->db->quote($this->getURL(), 'text') . ", " .
                    "dn =" . $this->db->quote($this->getDN(), 'text') . ", " .
                    "member_attribute = " . $this->db->quote($this->getMemberAttribute(), 'text') . ", " .
                    "member_isdn = " . $this->db->quote($this->getMemberISDN(), 'integer') . ", " .
                    "role = " . $this->db->quote($this->getRole(), 'integer') . ", " .
                    "mapping_info = " . $this->db->quote($this->getMappingInfo(), 'text') . ", " .
                    "mapping_info_type = " . $this->db->quote($this->getMappingInfoType(), 'integer') . " " .
                    "WHERE mapping_id = " . $this->db->quote($this->getMappingId(), 'integer');
        $res = $this->db->manipulate($query);
    }
    
    /**
     * create new mapping
     */
    public function save()
    {
        $this->setMappingId($this->db->nextId('ldap_rg_mapping'));
        $query = "INSERT INTO ldap_rg_mapping (mapping_id,server_id,url,dn,member_attribute,member_isdn,role,mapping_info,mapping_info_type) " .
                    "VALUES ( " .
                    $this->db->quote($this->getMappingId(), 'integer') . ", " .
                    $this->db->quote($this->getServerId(), 'integer') . ", " .
                    $this->db->quote($this->getURL(), 'text') . ", " .
                    $this->db->quote($this->getDN(), 'text') . ", " .
                    $this->db->quote($this->getMemberAttribute(), 'text') . ", " .
                    $this->db->quote($this->getMemberISDN(), 'integer') . ", " .
                    $this->db->quote($this->getRole(), 'integer') . ", " .
                    $this->db->quote($this->getMappingInfo(), 'text') . ", " .
                    $this->db->quote($this->getMappingInfoType(), 'integer') .
                    ")";
        $res = $this->db->manipulate($query);
    }
    
    /**
     * get mapping id
     * @return int mapping id
     */
    public function getMappingId()
    {
        return $this->mapping_id;
    }
    
    /**
     * set mapping id
     * @param int $a_value mapping id
     */
    public function setMappingId($a_value)
    {
        $this->mapping_id = $a_value;
    }
    
    /**
     * get server id
     * @return int server id id
     */
    public function getServerId()
    {
        return $this->server_id;
    }
    
    /**
     * set server id
     * @param int $a_value server id
     */
    public function setServerId($a_value)
    {
        $this->server_id = $a_value;
    }
    
    /**
     * get url
     * @return string url
     */
    public function getURL()
    {
        return $this->url;
    }
    
    /**
     * set url
     * @param string $a_value url
     */
    public function setURL($a_value)
    {
        $this->url = $a_value;
    }
    
    /**
     * get group dn
     * @return string
     */
    public function getDN()
    {
        return $this->dn;
    }
    
    /**
     * set group dn
     * @param string $a_value
     */
    public function setDN($a_value)
    {
        $this->dn = $a_value;
    }
    
    /**
     * get Group Member Attribute
     * @return string
     */
    public function getMemberAttribute()
    {
        return $this->member_attribute;
    }
    
    /**
     * set Group Member Attribute
     * @param string $a_value
     */
    public function setMemberAttribute($a_value)
    {
        $this->member_attribute = $a_value;
    }
    
    /**
     * get Member Attribute Value is DN
     * @return bool
     */
    public function getMemberISDN()
    {
        return $this->member_isdn;
    }
    
    /**
     * set Member Attribute Value is DN
     * @param bool $a_value
     */
    public function setMemberISDN($a_value)
    {
        $this->member_isdn = $a_value;
    }
    
    /**
     * get ILIAS Role Name id
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * set ILIAS Role Name id
     * @param int $a_value
     */
    public function setRole($a_value)
    {
        $this->role = $a_value;
    }
    
    /**
     * get ILIAS Role Name
     * @global type $ilObjDataCache
     * @return string
     */
    public function getRoleName()
    {
        global $DIC;

        $ilObjDataCache = $DIC['ilObjDataCache'];
        return $ilObjDataCache->lookupTitle($this->role);
    }
    
    /**
     * set ILIAS Role Name
     * @global ilRbacReview $rbacreview
     * @param string $a_value
     */
    public function setRoleByName($a_value)
    {
        global $DIC;

        $rbacreview = $DIC['rbacreview'];
        $this->role = $rbacreview->roleExists(ilUtil::stripSlashes($a_value));
    }
    
    /**
     * get Information Text
     * @return string
     */
    public function getMappingInfo()
    {
        return $this->mapping_info;
    }
    
    /**
     * set Information Text
     * @param string $a_value
     */
    public function setMappingInfo($a_value)
    {
        $this->mapping_info = $a_value;
    }
    
    /**
     * get Show Information also in the Repository/Personal Desktop
     * @return bool
     */
    public function getMappingInfoType()
    {
        return $this->mapping_info_type;
    }
    
    /**
     * set Show Information also in the Repository/Personal Desktop
     * @param bool $a_value
     */
    public function setMappingInfoType($a_value)
    {
        $this->mapping_info_type = $a_value;
    }
}
