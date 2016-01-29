# Xillion Core: Resource Management Framework

<img src="https://avatars3.githubusercontent.com/u/16952776" style="width: 100%" />

## What is Xillion?

Xillion is an framework for managing large amounts of resources in cross-service environments.

It's heavily inspired by Amazon's ARNs and security policies.

It allows for decentralized, highly flexible security access control, logging, and more.

This is work in progress. See `test/` for examples of usage.

## XRNs (Xillion Resource Names)

Xillion implements a `Resource` class that can be instantiated through an 'XRN'.

An XRN (Xillion Resource Name) is a special string format for identifying resources. It is heavily inspired by [Amazons ARNs](http://docs.aws.amazon.com/general/latest/gr/aws-arns-and-namespaces.html)

An XRN is a string separated by semicolons, and each section has a specific meaning:

```
xrn:partition:service:region:account:resource
xrn:partition:service:region:account:resourcetype/resource
xrn:partition:service:region:account:resourcetype:resource
```

* xrn: Every XRN starts with the prefix `xrn`
* partition: Partitions are used if your applications and services are split into multiple "partitions". For example, if your app is used in both healthcare and business environments, and the resources in those environments should never have to interact, you can put those in their own partition. Example partition names: "business", "healthcare", "internal", "production", "staging", "public", etc.
* Service: XRNs can be used to identify resources across services. This field would contain the service name that manages that resource. Example service names: "database", "authentication", etc
* Region: If your service can be split over multiple regions (datacenters), you can identify those region names here. Example resource names "eu-west-1", "europe", "asia", "local", etc
* account-id: If a resource is "owned" by a specific account, you can identify it here. Account names can be account ids, usernames, etc. Example account names: "18293123", "account-1", "customer-a", etc.
* resourcetype: If your service manages multiple resource types, you specify them here. Example resource types: "vm", "disk", "ip", etc.
* resource: This field contains the "id" or "key" of the resource of that specific type.

An example:
```
xrn:staging:authentication:eu-1:joe:session/129332
```

This XRN identifies *session 129332* in the *authentication* service of account *joe* in your *eu-1* datacenter in the *staging* environment.

## Running tests

```sh
vendor/bin/phpunit test/
```

## License

MIT (see [LICENSE](LICENSE))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
