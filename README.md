# contacts_export

This ownCloud app allows to export contacts from the official contacts app in a way that resembles the status quo (manually grouped by address, then grouped by family name, then ordered by given name).

## development setup

To push to cloud.efg-ludwigshafen.de you need ssh access to efg-ludwigshafen.de (ask dominik.schreiber@efg-ludwigshafen.de), then, on your local machine, perform

```bash
git remote add production ssh://<you>@efg-ludwigshafen.de/home/dominik/git/contacts-export.git
git push production master
```
