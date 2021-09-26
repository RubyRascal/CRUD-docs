<?php
require_once 'func_docs.php';
class viewListDocs
{
    public function viewListDocs()
    {
        $DocArr = getDocsArray();
        require_once 'listDocs.php';
    }
}