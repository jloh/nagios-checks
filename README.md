nagios-checks
=============

## SolusVM Scripts

### Bandwidth
A quick and dirty script to check a SoluSVM VM's bandwidth and issue a WARNING when over 80% and go critical when over 90%.<BR>
[File](./solusvm_check_bandwidth.php) - [Blog Post](https://www.mooash.me/monitor-solusvm-bandwidth-usage-nagios/)

## [Clickatell](https://www.clickatell.com/)

### Credit Check
Check current Clickatell credit via their HTTP API
[File](./check_credit)

#### Requirements
 * Clickatell Username
 * Clickatell Password
 * Clickatell App ID
 * CURL
 * AWK

#### Usage
```
./check_credit -user Example -pass 1234567 -api 44319 -w 20 -c 10
```
