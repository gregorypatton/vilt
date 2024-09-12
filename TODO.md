# TODO: Models for Inventory Management System in Laravel 11, PHP 8, Inertia, and Vue

## 1. [ ] **User**
- **Relationships**:
  - [ ] `belongsTo` `Seller` (`seller_id`)
  - [ ] `hasMany` `Report` (Generated reports)
  - [ ] `hasMany` `PurchaseOrder`, `Part`, `WorkOrder`
  - [ ] `hasMany` `AuditLog` (Activity log for user actions)

- **Potential Functions**:
  - [ ] `createUser(array $data)`
  - [ ] `updateUser(User $user, array $data)`
  - [ ] `deleteUser(User $user)`
  - [ ] `authenticateUser(Request $request)`
  - [ ] `assignRole(User $user, string $role)`

- **Multitenancy Considerations**:
  - Use Laravel's **policies** and **gates** for permission-based access control. 
  - Ensure `User` actions are scoped by the `seller_id`, so users can only see or manipulate data tied to their tenant.
  - Middleware like `auth:sanctum` can be leveraged to authenticate API requests.

---

## 2. [ ] **Seller**
- **Relationships**:
  - [ ] `hasMany` `User`
  - [ ] `hasMany` `Product`, `Part`, `PurchaseOrder`, `WorkOrder`, `Report`, `PrepLabor`
  - [ ] `hasMany` `Contractor`, `Settlement`

- **Potential Functions**:
  - [ ] `createSeller(array $data)`
  - [ ] `updateSeller(Seller $seller, array $data)`
  - [ ] `deleteSeller(Seller $seller)`
  - [ ] `manageSubscription(Seller $seller)`
  - [ ] `generateReport(Seller $seller, string $reportType)`

- **Multitenancy Considerations**:
  - Use Laravel's **Tenant Middleware** to automatically bind requests to the correct `Seller`.
  - Make sure every query is scoped by `seller_id` to enforce tenant boundaries.

---

## 3. [ ] **Product**
- **Relationships**:
  - [ ] `belongsTo` `Seller`
  - [ ] `hasMany` `ProductPart`
  - [ ] `hasMany` `ProductChannel`
  - [ ] `hasMany` `WorkOrder`

- **Potential Functions**:
  - [ ] `createProduct(array $data)`
  - [ ] `updateProduct(Product $product, array $data)`
  - [ ] `deleteProduct(Product $product)`
  - [ ] `getProductParts(Product $product)`
  - [ ] `calculateCost(Product $product)`
  - [ ] `listProductChannels(Product $product)`

- **Multitenancy Considerations**:
  - Make use of **global scopes** in Eloquent to ensure `Product` queries are always filtered by `seller_id`.
  - Laravel's **query caching** (with Redis or other caches) can be used to speed up large product listings.

---

## 4. [ ] **ProductPart**
- **Relationships**:
  - [ ] `belongsTo` `Product`
  - [ ] `belongsTo` `Part`

- **Potential Functions**:
  - [ ] `addPartToProduct(Product $product, Part $part, int $quantity)`
  - [ ] `removePartFromProduct(Product $product, Part $part)`
  - [ ] `updatePartQuantity(ProductPart $productPart, int $quantity)`

- **Multitenancy Considerations**:
  - Leverage Eloquent **relationships** so `ProductPart` queries always return records within the tenant's context via `Product` and `Part`.
  - Keep efficiency in mind by using **eager loading** to avoid N+1 query issues when accessing parts for products.

---

## 5. [ ] **Part**
- **Relationships**:
  - [ ] `belongsTo` `Seller`
  - [ ] `hasMany` `ProductPart`
  - [ ] `hasMany` `PartInventory`
  - [ ] `hasMany` `PurchaseOrderPart`

- **Potential Functions**:
  - [ ] `createPart(array $data)`
  - [ ] `updatePart(Part $part, array $data)`
  - [ ] `deletePart(Part $part)`
  - [ ] `getInventoryStatus(Part $part)`
  - [ ] `getRelatedProducts(Part $part)`

- **Multitenancy Considerations**:
  - Ensure that each `Part` is associated with a `seller_id` and scoped to the correct tenant. 
  - Use **soft deletes** in Eloquent to prevent data loss when removing parts.
  - Cache part data to optimize frequent lookups, especially for stock and inventory levels.

---

## 6. [ ] **PartInventory**
- **Relationships**:
  - [ ] `belongsTo` `Part`
  - [ ] `belongsTo` `Location`

- **Potential Functions**:
  - [ ] `addInventory(Part $part, Location $location, int $quantity)`
  - [ ] `removeInventory(Part $part, Location $location, int $quantity)`
  - [ ] `getPartInventory(Part $part)`
  - [ ] `transferInventory(Part $part, Location $fromLocation, Location $toLocation, int $quantity)`

- **Multitenancy Considerations**:
  - Ensure that inventory is scoped by `part_id` and `seller_id`.
  - Use **Laravel Queues** to manage large-scale inventory transfers efficiently, keeping the UI responsive.

---

## 7. [ ] **Location**
- **Relationships**:
  - [ ] `belongsTo` `Seller`
  - [ ] `hasMany` `PartInventory`

- **Potential Functions**:
  - [ ] `createLocation(array $data)`
  - [ ] `updateLocation(Location $location, array $data)`
  - [ ] `deleteLocation(Location $location)`
  - [ ] `listPartsInLocation(Location $location)`

- **Multitenancy Considerations**:
  - Ensure each location is scoped by `seller_id` to avoid cross-tenant data leakage.
  - For large-scale systems with multiple locations, consider **geo-location indexing** for faster queries when managing locations with large datasets.

---

## 8. [ ] **PurchaseOrder**
- **Relationships**:
  - [ ] `belongsTo` `Seller`
  - [ ] `hasMany` `PurchaseOrderPart`
  - [ ] `belongsTo` `Supplier`

- **Potential Functions**:
  - [ ] `createPO(array $data)`
  - [ ] `updatePO(PurchaseOrder $purchaseOrder, array $data)`
  - [ ] `deletePO(PurchaseOrder $purchaseOrder)`
  - [ ] `getPOParts(PurchaseOrder $purchaseOrder)`
  - [ ] `calculatePOTotal(PurchaseOrder $purchaseOrder)`

- **Multitenancy Considerations**:
  - Purchase Orders should always be linked to the correct `seller_id` to keep them tenant-scoped.
  - Use **eager loading** for related parts and suppliers to optimize PO retrieval.

---

## 9. [ ] **PurchaseOrderPart**
- **Relationships**:
  - [ ] `belongsTo` `PurchaseOrder`
  - [ ] `belongsTo` `Part`

- **Potential Functions**:
  - [ ] `addPartToPO(PurchaseOrder $purchaseOrder, Part $part, int $quantity)`
  - [ ] `removePartFromPO(PurchaseOrder $purchaseOrder, Part $part)`
  - [ ] `calculatePartTotal(PurchaseOrderPart $purchaseOrderPart)`

- **Multitenancy Considerations**:
  - Since `PurchaseOrderPart` is related to both `PurchaseOrder` and `Part`, ensure that both are tenant-aware via their `seller_id`.
  - Use **transactional database operations** to ensure data consistency when updating multiple parts in a PO.

---

## 10. [ ] **Supplier**
- **Relationships**:
  - [ ] `hasMany` `Part`
  - [ ] `hasMany` `PurchaseOrder`

- **Potential Functions**:
  - [ ] `createSupplier(array $data)`
  - [ ] `updateSupplier(Supplier $supplier, array $data)`
  - [ ] `deleteSupplier(Supplier $supplier)`
  - [ ] `listSuppliedParts(Supplier $supplier)`

- **Multitenancy Considerations**:
  - Although suppliers may be shared across sellers, the parts and purchase orders associated with them should always be tenant-scoped.

---

## 11. [ ] **WorkOrder**
- **Relationships**:
  - [ ] `belongsTo` `PurchaseOrder`
  - [ ] `belongsTo` `Contractor`

- **Potential Functions**:
  - [ ] `createWorkOrder(array $data)`
  - [ ] `updateWorkOrder(WorkOrder $workOrder, array $data)`
  - [ ] `completeWorkOrder(WorkOrder $workOrder)`
  - [ ] `listWorkOrderTasks(WorkOrder $workOrder)`

- **Multitenancy Considerations**:
  - All `WorkOrder` entries should be scoped by `seller_id` to ensure contractors only access appropriate data.
  - **Task queues** should be used for processing long-running work orders, keeping the UI responsive.

---

## 12. [ ] **Contractor**
- **Relationships**:
  - [ ] `hasMany` `WorkOrder`

- **Potential Functions**:
  - [ ] `registerContractor(array $data)`
  - [ ] `assignWorkOrder(Contractor $contractor, WorkOrder $workOrder)`
  - [ ] `completeWorkOrder(Contractor $contractor, WorkOrder $workOrder)`

- **Multitenancy Considerations**:
  - Ensure that contractors can only access work orders and data relevant to the `seller_id` they are associated with.

---

## 13. [ ] **ContractorSignoff**
- **Relationships**:
  - [ ] `belongsTo` `Contractor`
  - [ ] `belongsTo` `WorkOrder`

- **Potential Functions**:
  - [ ] `createSignoff(array $data)`
  - [ ] `verifySignature(ContractorSignoff $signoff)`
  - [ ] `getSignoffDetails(ContractorSignoff $signoff)`

- **Multitenancy Considerations**:
  - `ContractorSignoff` data should always be linked to the correct `seller_id` via `WorkOrder`.

---

## 14. [ ] **Settlement**
- **Relationships**:
  - [ ] `belongsTo` `Seller`

- **Potential Functions**:
  - [ ] `createSettlement(Seller $seller, float $amount)`
  - [ ] `processSettlement(Settlement $settlement)`
  - [ ] `generateSettlementReport(Seller $seller)`

- **Multitenancy Considerations**:
  - Settlements should always be scoped by `seller_id`, ensuring that financial data is isolated between tenants.

---

## 15. [ ] **PrepLabor**
- **Relationships**:
  - [ ] `belongsTo` `Seller`

- **Potential Functions**:
  - [ ] `createPrepLabor(array $data)`
  - [ ] `updatePrepLabor(PrepLabor $prepLabor, array $data)`
  - [ ] `deletePrepLabor(PrepLabor $prepLabor)`
  - [ ] `calculateLaborCost(PrepLabor $prepLabor)`

- **Multitenancy Considerations**:
  - Labor cost calculations should be scoped by `seller_id` and stored efficiently, as this data might be accessed frequently for product preparation.
