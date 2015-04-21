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

    public function getDoctorById($personId) {
        $sql = "SELECT d.*, p.* FROM Doctor d
                INNER JOIN Person p USING (PersonId)
                WHERE p.PersonId = :id
                LIMIT 1";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':id', $personId, \PDO::PARAM_INT);
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

    public function getFacilityById($facilityId) {
        $sql = "SELECT o.*, ot.OrganizationType FROM Organization o
                INNER JOIN OrganizationType ot USING (TypeId)
                WHERE o.OrganizationId = :orgId";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':orgId', $facilityId, \PDO::PARAM_INT);
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

    public function getNurseById($personId) {
        $sql = "SELECT n.*, p.* FROM Nurse n
                INNER JOIN Person p USING (PersonId)
                WHERE p.PersonId = :id
                LIMIT 1";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':id', $personId, \PDO::PARAM_INT);
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

    public function getPatientById($personId) {
        $sql = "SELECT p.* FROM Person p
                WHERE p.PersonId = :id
                LIMIT 1";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':id', $personId, \PDO::PARAM_INT);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function getPatientsByPrimaryCareDoctor($primCareDrId) {
        $sql = "SELECT p.* FROM Person p
                WHERE p.PrimCareDrId = :docId
                ORDER BY p.LastName, p.FirstName";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':docId', $primCareDrId, \PDO::PARAM_INT);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }

    public function assignNurseToDoctorAtFacility($nurseId, $doctorId, $facilityId) {
        $sql = "UPDATE Appointment SET NurseId = :nurseId
                WHERE DoctorId = :docId AND OrganizationId = :orgId AND AppointmentDateTime > NOW()";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(':nurseId', $nurseId, \PDO::PARAM_INT);
        $sth->bindParam(':docId', $doctorId, \PDO::PARAM_INT);
        $sth->bindParam(':orgId', $facilityId, \PDO::PARAM_INT);
        $sth->execute();
    }
}