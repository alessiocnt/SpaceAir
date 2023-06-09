<?php 



class AddressHandler extends AbstractHandler {

    public function __construct(ModelHelper $model) {
        parent::__construct($model);
    }

    public function getAddress($idUser) {
        $db = $this->getModelHelper()->getDbManager()->getDb();
        $stmt = $db->prepare("SELECT * FROM ADDRESS WHERE IdUser = ? AND Visible = 1");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        $builder = new AddressBuilder();
        foreach ($result as $res) {
            return $builder->createFromAssoc($res);
        }
        
    }
}
