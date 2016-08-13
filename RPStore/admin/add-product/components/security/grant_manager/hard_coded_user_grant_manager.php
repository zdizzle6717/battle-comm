<?php

include_once dirname(__FILE__) . '/' . 'user_grant_manager.php';

class HardCodedUserGrantManager extends UserGrantManager {
    private $dataSourceGrants;

    /** @var IDataSourceSecurityInfo[] */
    private $applicationGrants;
    private $defaultUserName;

    public function __construct(
        array $dataSourceGrants,
        array $applicationGrants,
        $defaultUserName = 'defaultUser',
        $guestUserName = 'guest') {
        $this->dataSourceGrants = $dataSourceGrants;
        $this->applicationGrants = $applicationGrants;
        $this->defaultUserName = $defaultUserName;
        $this->guestUserName = $guestUserName;
    }

    private function ApplyDefaultUserGrants(IDataSourceSecurityInfo $userGrants, $dataSourceName) {
        if (isset($this->applicationGrants[$this->defaultUserName]))
            $defaultUserAppGrants = $this->applicationGrants[$this->defaultUserName];
        else
            $defaultUserAppGrants = new DataSourceSecurityInfo(false, false, false, false);

        if (isset($this->dataSourceGrants[$this->defaultUserName])) {
            if (isset($this->dataSourceGrants[$this->defaultUserName][$dataSourceName]))
                $defaultUserDataSourceGrants = $this->dataSourceGrants[$this->defaultUserName][$dataSourceName];
            else
                $defaultUserDataSourceGrants = new DataSourceSecurityInfo(false, false, false, false);
        } else
            $defaultUserDataSourceGrants = new DataSourceSecurityInfo(false, false, false, false);

        return SecurityInfoUtils::Merge(array($defaultUserAppGrants, $defaultUserDataSourceGrants, $userGrants));
    }

    private function ApplyApplicationGrants(IDataSourceSecurityInfo $userGrants, $userName) {
        if (isset($this->applicationGrants[$userName]))
            $userAppGrants = $this->applicationGrants[$userName];
        else
            $userAppGrants = new DataSourceSecurityInfo(false, false, false, false);
        return SecurityInfoUtils::Merge(array($userAppGrants, $userGrants));
    }

    private function IsGuestUserName($userName) {
        return $userName == $this->guestUserName;
    }

    public function HasAdminGrant($userName) {
        return isset($this->applicationGrants[$userName]) &&
        $this->applicationGrants[$userName]->AdminGrant();
    }

    private function FindDataSourceGrants($userName) {
        foreach ($this->dataSourceGrants as $name => $grants)
            if (StringUtils::SameText($name, $userName))
                return $this->dataSourceGrants[$name];
        return null;
    }

    /**
     * @inheritdoc
     */
    public function GetSecurityInfo($userName, $dataSourceName) {
        $result = new DataSourceSecurityInfo(false, false, false, false);
        $grants = $this->FindDataSourceGrants($userName);
        if (isset($grants)) {
            if (isset($grants[$dataSourceName])) {
                $result = $grants[$dataSourceName];
            }
        }
        if (!$this->IsGuestUserName($userName))
            $result = $this->ApplyDefaultUserGrants($result, $dataSourceName);
        $result = $this->ApplyApplicationGrants($result, $userName);
        return $result;
    }
}