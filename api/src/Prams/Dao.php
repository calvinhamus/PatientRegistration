<?php
namespace Prams;

class Dao {
    private $_dbh;

    public function __construct() {
        $conn = new DbConnection();
        $this->_dbh = $conn->getDbh();
    }

    public function getAllDoctors() {
        $sql = "SELECT d.*, p.* FROM Doctor d
                INNER JOIN Person p USING (PersonId)
                ORDER BY p.LastName, p.FirstName";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function getDoctorsByFacilityId($facilityId) {
        $sql = "SELECT d.*, p.* FROM Doctor d
                INNER JOIN Person p USING (PersonId)
                INNER JOIN Affiliation a ON p.PersonId = a.DoctorId
                WHERE a.OrganizationId = :orgId AND a.IsCurrent = 1
                ORDER BY p.LastName, p.FirstName";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':orgId', $facilityId, \PDO::PARAM_INT);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function getAllFacilities() {
        $sql = "SELECT o.*, ot.OrganizationType FROM Organization o
                INNER JOIN OrganizationType ot USING (TypeId)";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function getAllNurses() {
        $sql = "SELECT n.*, p.* FROM Nurse n
                INNER JOIN Person p USING (PersonId)
                ORDER BY p.LastName, p.FirstName";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function getAllPatients() {
        $sql = "SELECT p.* FROM Person p
                ORDER BY p.LastName, p.FirstName";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }
}