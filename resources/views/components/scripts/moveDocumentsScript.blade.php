
<script>
    function callToDocumentMove(doc, new_parent){
        moveurl = "{{route("documents.move",["condominium"=>$condominium->id,"document"=>-1,"parent"=>-2])}}";
        moveurl = moveurl.replace("-1",doc);
        moveurl = moveurl.replace("-2",new_parent);
        window.location.href = moveurl;
    }
</script>
