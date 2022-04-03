<div class="container-fluid pt-3">
    <h3 class="font-weight-light text-white">Kanban Board</h3>
    <div class="small  text-light">Drag and drop between swim lanes</div>
    <div class="row flex-row flex-sm-nowrap py-3">
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">To Do</h6>
                    <div class="items border border-light">

                        <?php
                        $taskTodo = getTasksByUserAndStatus($_SESSION['uzyszkodnik'],1);
foreach($taskTodo as $zadanieTodo):

include("templates/swimlane-item.php");

?>

                        <?php
endforeach;

                        if(count(getTasksByUserAndStatus($_SESSION['uzyszkodnik'],1))):?>

<!--                            --><?php
//                        var_dump(count(getTasksByUserAndStatus($_SESSION['uzyszkodnik'],1)));
//                            ?>

                        <?php endif;?>
                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">In-progess</h6>
                    <div class="items border border-light">

                                              <?php
                        $taskTodo = getTasksByUserAndStatus($_SESSION['uzyszkodnik'],2);
foreach($taskTodo as $zadanieTodo):

include("templates/swimlane-item.php");

?>

                        <?php
endforeach;
?>

                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">Review</h6>
                    <div class="items border border-light">


                        <?php
                        $taskTodo = getTasksByUserAndStatus($_SESSION['uzyszkodnik'],3);
                        foreach($taskTodo as $zadanieTodo):

                            include("templates/swimlane-item.php");

                            ?>

                        <?php
                        endforeach;
                        ?>


                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-truncate py-2">Complete</h6>
                    <div class="items border border-light">


                        <?php
                        $taskTodo = getTasksByUserAndStatus($_SESSION['uzyszkodnik'],4);
                        foreach($taskTodo as $zadanieTodo):

                            include("templates/swimlane-item.php");

                            ?>

                        <?php
                        endforeach;
                        ?>


                        <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>