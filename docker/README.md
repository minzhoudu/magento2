# TODO: Update this file

### common issues
- After settings up code quality tools you might end up with an ever increasing number docker volumes taking up disk space.
  phpmd and phpcsfixer will create anonymous volumes roughly ~28MB in size, each time you open up a file inside PHPStorm.
  To remove them you can use the following command:
    ```shell
    watch "docker volume ls  --format='{{.Name}} {{.Label \"com.project.name\"}}' | grep -v moto-bike-shop | xargs docker volume rm 2>/dev/null"
    ```
    We could execute `docker volume prune -f` under watch, but that's  a potentially destructive operation since it will
    remove all volumes that are not currently in use.

    We're using `watch` to repeatedly execute a command.
    The command or rather command pipeline will print out all volumes that do not have `moto-bike-shop` set as their project
    label. That result will get pased to `docker volume rm` that will ultimately delete the volumes.

    This command is safe to run regardless of whether the docker services of the project are running.
    Keep in mind the filter that's used. If you have volumes for some other projects or perhaps volumes for this project
    but you forgot to add a label, they will be removed.
